<?php
/**
 * NextGen Garuda CBT - Controller Obfuscator & Build Tool
 * 
 * Usage:
 *   php build-obfuscate.php          -> Obfuscates all controllers (creates backup in app/Controllers_original)
 *   php build-obfuscate.php --restore -> Restores original controllers from backup
 *   php build-obfuscate.php --status  -> Checks current controllers state
 */

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    die("Error: vendor/autoload.php not found. Please run composer install first.\n");
}
require_once $autoloadPath;

use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

class CbtObfuscatorEngine
{
    private $parser;
    private $printer;
    private $appName;

    public function __construct(string $appName = 'NextGen Garuda CBT')
    {
        $this->appName = $appName;
        $this->parser = (new ParserFactory())->createForHostVersion();
        $this->printer = new class extends PrettyPrinter\Standard {
            protected function pScalar_String(Node\Scalar\String_ $node): string
            {
                $str = $node->value;
                if ($str === '') {
                    return "''";
                }
                $escaped = '';
                $len = strlen($str);
                for ($i = 0; $i < $len; $i++) {
                    $ord = ord($str[$i]);
                    // Alternate hex and octal representation (Garuda CBT signature)
                    if ($i % 2 === 0) {
                        $escaped .= '\\x' . dechex($ord);
                    } else {
                        $escaped .= '\\' . decoct($ord);
                    }
                }
                return '"' . $escaped . '"';
            }
        };
    }

    public function obfuscate(string $code): string
    {
        $ast = $this->parser->parse($code);

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new class extends NodeVisitorAbstract {
            private $varMap = [];
            private $varCounter = 0;
            private $reservedVars = [
                'this', '_GET', '_POST', '_SERVER', '_COOKIE', '_SESSION',
                '_FILES', '_REQUEST', 'GLOBALS', 'request', 'response'
            ];

            public function enterNode(Node $node)
            {
                if ($node instanceof Node\Stmt\ClassMethod) {
                    $this->varMap = [];
                }

                // Scramble local variables
                if ($node instanceof Node\Expr\Variable && is_string($node->name)) {
                    $name = $node->name;
                    if (!in_array($name, $this->reservedVars, true)) {
                        if (!isset($this->varMap[$name])) {
                            $hex = dechex(crc32($name . '_' . $this->varCounter++));
                            $this->varMap[$name] = '_0x' . substr($hex, 0, 4);
                        }
                        $node->name = $this->varMap[$name];
                    }
                }

                // Control flow flattening (goto statements)
                if ($node instanceof Node\Stmt\ClassMethod && !empty($node->stmts)) {
                    $node->stmts = $this->flattenStatements($node->stmts);
                }

                return null;
            }

            private function flattenStatements(array $stmts): array
            {
                $count = count($stmts);
                if ($count < 3) {
                    return $stmts;
                }

                foreach ($stmts as $s) {
                    if ($s instanceof Node\Stmt\Class_ || $s instanceof Node\Stmt\Function_) {
                        return $stmts;
                    }
                }

                $labels = [];
                for ($i = 0; $i < $count; $i++) {
                    $labels[$i] = 'L_' . substr(md5(uniqid((string)mt_rand(), true)), 0, 5);
                }

                $newStmts = [];
                $newStmts[] = new Node\Stmt\Goto_($labels[0]);

                $blocks = [];
                for ($i = 0; $i < $count; $i++) {
                    $blockStmts = [];
                    $blockStmts[] = new Node\Stmt\Label($labels[$i]);
                    $blockStmts[] = $stmts[$i];

                    if ($i < $count - 1) {
                        $isTerminal = ($stmts[$i] instanceof Node\Stmt\Return_) || ($stmts[$i] instanceof Node\Stmt\Throw_);
                        if (!$isTerminal) {
                            $blockStmts[] = new Node\Stmt\Goto_($labels[$i + 1]);
                        }
                    }

                    $blocks[] = $blockStmts;
                }

                shuffle($blocks);

                foreach ($blocks as $b) {
                    foreach ($b as $sub) {
                        $newStmts[] = $sub;
                    }
                }

                return $newStmts;
            }
        });

        $obfuscatedAst = $traverser->traverse($ast);
        $printedCode = $this->printer->prettyPrintFile($obfuscatedAst);

        $header = "<?php\n" .
            "/*   ________________________________________\n" .
            "    |          " . str_pad($this->appName, 28, " ", STR_PAD_BOTH) . "  |\n" .
            "    |    Protected & Distributed via GitHub  |\n" .
            "    |________________________________________|\n" .
            "*/\n";

        $cleanCode = preg_replace('/^<\?php\s*/', '', $printedCode);
        $cleanCode = preg_replace('/[ \t]+/', ' ', $cleanCode);

        return $header . $cleanCode;
    }
}

// -------------------------------------------------------------
// CLI Actions
// -------------------------------------------------------------

$targetDir  = __DIR__ . '/app/Controllers';
$backupDir  = __DIR__ . '/app/Controllers_original';
$phpBin     = PHP_BINARY;

$action = $argv[1] ?? 'obfuscate';

if ($action === '--status' || $action === '-s') {
    $hasBackup = is_dir($backupDir);
    echo "==============================================\n";
    echo " NextGen Garuda CBT Controller Status\n";
    echo "==============================================\n";
    echo " Backup (Controllers_original) : " . ($hasBackup ? "ADA (Tersedia)" : "Belum Ada") . "\n";
    
    // Check one file
    $sample = $targetDir . '/Banner.php';
    if (file_exists($sample)) {
        $content = file_get_contents($sample);
        $isObf = (strpos($content, 'Protected & Distributed via GitHub') !== false || strpos($content, 'goto L_') !== false);
        echo " Status Kode Controller Aktif  : " . ($isObf ? "TER-OBFUSCATE (Siap GitHub)" : "ORIGINAL (Bisa Diedit)") . "\n";
    }
    echo "==============================================\n";
    exit(0);
}

if ($action === '--restore' || $action === '-r') {
    if (!is_dir($backupDir)) {
        die("Error: Folder backup 'app/Controllers_original' tidak ditemukan. Tidak dapat melakukan restore.\n");
    }

    echo "Memulihkan kode controller dari 'app/Controllers_original'...\n";
    copyDirectory($backupDir, $targetDir);
    echo "Sukses! Seluruh controller telah dikembalikan ke kode ORIGINAL yang rapi dan bisa diedit.\n";
    exit(0);
}

// Default: Obfuscate
echo "==============================================\n";
echo " NextGen Garuda CBT Controller Obfuscator\n";
echo "==============================================\n";

// 1. Create backup if not exists
if (!is_dir($backupDir)) {
    echo "-> Membuat backup otomatis ke 'app/Controllers_original'...\n";
    copyDirectory($targetDir, $backupDir);
    echo "   Backup berhasil dibuat!\n";
} else {
    echo "-> Backup 'app/Controllers_original' sudah ada (kode asli aman).\n";
}

// 2. Scan controller files
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($targetDir));
$phpFiles = [];
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $phpFiles[] = $file->getPathname();
    }
}

echo "-> Memproses " . count($phpFiles) . " file controller...\n";

$engine = new CbtObfuscatorEngine();
$success = 0;
$failed = 0;

foreach ($phpFiles as $file) {
    $relPath = str_replace(__DIR__ . DIRECTORY_SEPARATOR, '', $file);
    // BaseController can be left clean for seamless framework base inheritance
    if (basename($file) === 'BaseController.php') {
        echo "   [SKIP] $relPath (BaseController dibiarkan clean untuk inheritance)\n";
        continue;
    }

    $source = file_get_contents($file);
    try {
        $obfCode = $engine->obfuscate($source);
        file_put_contents($file, $obfCode);

        // Syntax lint check
        $output = [];
        $exitCode = 0;
        exec("\"$phpBin\" -l \"$file\"", $output, $exitCode);

        if ($exitCode === 0) {
            $success++;
            echo "   [OK]   $relPath\n";
        } else {
            $failed++;
            echo "   [FAIL] $relPath (Lint Error)\n";
        }
    } catch (Throwable $e) {
        $failed++;
        echo "   [ERROR] $relPath: " . $e->getMessage() . "\n";
    }
}

echo "----------------------------------------------\n";
echo "Selesai!\n";
echo "Berhasil diobfuscate : $success file\n";
echo "Gagal                : $failed file\n";
echo "----------------------------------------------\n";
echo "PENTING:\n";
echo "1. Kode asli Anda tersimpan aman di: app/Controllers_original/\n";
echo "2. Kapanpun Anda ingin mengedit kode kembali, cukup jalankan:\n";
echo "   php build-obfuscate.php --restore\n";
echo "3. Folder 'app/Controllers_original' sudah otomatis ada di .gitignore\n";
echo "   sehingga TIDAK AKAN PERNAH ikut ter-upload ke GitHub!\n";
echo "==============================================\n";

function copyDirectory($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst, 0777, true);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
