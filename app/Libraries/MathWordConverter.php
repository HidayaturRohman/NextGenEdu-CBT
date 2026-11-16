<?php

namespace App\Libraries;

use DOMDocument;
use DOMXPath;

class MathWordConverter
{
    /**
     * Process HTML containing KaTeX / MathML / LaTeX formulas
     * so that Microsoft Word renders them as native equations (OMath)
     * without duplicated text, missing fonts, or raw LaTeX syntax.
     */
    public static function process(string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // 1. Process KaTeX DOM structures first (the primary way CBT stores math)
        if (stripos($html, 'katex') !== false) {
            $html = self::cleanKaTeXViaDom($html);
        }

        // 2. Handle display math: $$...$$ or \[...\]
        $html = preg_replace_callback('/(?:\$\$|\\\\\[)(.+?)(?:\$\$|\\\\\])/s', function ($m) {
            return ' ' . self::latexToMathML(trim($m[1]), true) . ' ';
        }, $html);

        // 3. Handle inline math: \(...\)
        $html = preg_replace_callback('/\\\\\((.+?)\\\\\)/s', function ($m) {
            return ' ' . self::latexToMathML(trim($m[1]), false) . ' ';
        }, $html);

        // 4. Handle inline math: $...$
        $html = preg_replace_callback('/(?<!\\\\)\$([^\$\n\r]+?)(?<!\\\\)\$/s', function ($m) {
            $content = trim($m[1]);
            // Skip currency amounts like $100 or $5.50
            if (preg_match('/^\d+([.,]\d+)?$/', $content)) {
                return $m[0];
            }
            return ' ' . self::latexToMathML($content, false) . ' ';
        }, $html);

        // 5. Handle loose structured LaTeX expressions outside of <math> tags
        $html = self::convertLooseLatex($html);

        // 6. Final safety pass for loose LaTeX symbols in plain text outside <math>
        $html = self::cleanRemainingLatexSymbols($html);

        // Normalize multiple spaces (preserving single space)
        $html = preg_replace('/[ \t]{2,}/', ' ', $html);

        return trim($html);
    }

    /**
     * Clean KaTeX elements using DOMDocument to preserve valid HTML tree.
     */
    protected static function cleanKaTeXViaDom(string $html): string
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        // Load with UTF-8 encoding wrapper
        $dom->loadHTML('<?xml encoding="utf-8" ?><div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Find all elements with class 'katex'
        $katexNodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' katex ')]");
        $items = [];
        foreach ($katexNodes as $node) {
            $items[] = $node;
        }

        foreach ($items as $node) {
            if (!$node->parentNode) {
                continue;
            }

            // Look for <math> child
            $mathList = $node->getElementsByTagName('math');
            if ($mathList->length > 0) {
                $mathNode = $mathList->item(0);

                // Strip any <annotation> tags (which contain the duplicated raw LaTeX text!)
                $annotations = $mathNode->getElementsByTagName('annotation');
                $annList = [];
                foreach ($annotations as $ann) {
                    $annList[] = $ann;
                }
                foreach ($annList as $ann) {
                    if ($ann->parentNode) {
                        $ann->parentNode->removeChild($ann);
                    }
                }

                // Unwrap <semantics> if present to leave clean standard MathML
                $semantics = $mathNode->getElementsByTagName('semantics');
                if ($semantics->length > 0) {
                    $semNode = $semantics->item(0);
                    while ($semNode->hasChildNodes()) {
                        $child = $semNode->firstChild;
                        $semNode->removeChild($child);
                        $mathNode->appendChild($child);
                    }
                    if ($semNode->parentNode) {
                        $semNode->parentNode->removeChild($semNode);
                    }
                }

                // Ensure single xmlns attribute
                $mathNode->setAttribute('xmlns', 'http://www.w3.org/1998/Math/MathML');

                $spBefore = $dom->createTextNode(' ');
                $spAfter = $dom->createTextNode(' ');

                $parent = $node->parentNode;
                $parent->insertBefore($spBefore, $node);
                $parent->insertBefore($mathNode, $node);
                $parent->insertBefore($spAfter, $node);
                $parent->removeChild($node);
            } else {
                // If no <math>, check if annotation with TeX exists
                $annList = $node->getElementsByTagName('annotation');
                if ($annList->length > 0) {
                    $tex = $annList->item(0)->textContent;
                    $mathXml = self::latexToMathML($tex, false);
                    $frag = $dom->createDocumentFragment();
                    $frag->appendXML(' ' . $mathXml . ' ');
                    $node->parentNode->replaceChild($frag, $node);
                } else {
                    // Remove katex-html to prevent duplicates
                    $htmlSpans = $xpath->query(".//*[contains(concat(' ', normalize-space(@class), ' '), ' katex-html ')]", $node);
                    foreach ($htmlSpans as $hs) {
                        if ($hs->parentNode) {
                            $hs->parentNode->removeChild($hs);
                        }
                    }
                }
            }
        }

        $out = $dom->saveHTML();
        $out = preg_replace('/<\?xml.*?\?>/i', '', $out);
        $out = preg_replace('/^<div>/i', '', $out);
        $out = preg_replace('/<\/div>$/i', '', $out);

        return trim($out);
    }

    /**
     * Convert loose structured LaTeX expressions outside of <math> tags.
     */
    protected static function convertLooseLatex(string $html): string
    {
        // Split text by <math ...>...</math> blocks so we only process content outside of MathML
        $parts = preg_split('/(<math\b[^>]*>.*?<\/math>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $out = '';
        foreach ($parts as $part) {
            if (empty($part)) continue;
            if (str_starts_with(trim($part), '<math')) {
                $out .= $part;
            } else {
                // 1. Fractions: \frac{...}{...} or \dfrac{...}{...}
                $patternFrac = '/\\\\d?frac\{((?:[^{}]+|(?R))*)\}\{((?:[^{}]+|(?R))*)\}/s';
                if (preg_match($patternFrac, $part)) {
                    $part = preg_replace_callback($patternFrac, function ($m) {
                        return self::latexToMathML($m[0], false);
                    }, $part);
                }

                // 2. Square roots: \sqrt{...} or \sqrt[n]{...}
                $patternSqrt = '/\\\\sqrt(?:\[(.*?)\])?\{((?:[^{}]+|(?R))*)\}/s';
                if (preg_match($patternSqrt, $part)) {
                    $part = preg_replace_callback($patternSqrt, function ($m) {
                        return self::latexToMathML($m[0], false);
                    }, $part);
                }

                $out .= $part;
            }
        }
        return $out;
    }

    /**
     * Replace remaining loose LaTeX syntax in plain text outside <math> tags
     * with clean Unicode mathematical equivalents.
     */
    protected static function cleanRemainingLatexSymbols(string $html): string
    {
        $parts = preg_split('/(<math\b[^>]*>.*?<\/math>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $out = '';
        $replacements = [
            '\\left\\{' => '{',
            '\\right\\}' => '}',
            '\\{'       => '{',
            '\\}'       => '}',
            '\\left('   => '(',
            '\\right)'  => ')',
            '\\left['   => '[',
            '\\right]'  => ']',
            '\\left|'   => '|',
            '\\right|'  => '|',
            '\\left.'   => '',
            '\\right.'  => '',
            '\\in'      => '∈',
            '\\notin'   => '∉',
            '\\times'   => '×',
            '\\cdot'    => '⋅',
            '\\div'     => '÷',
            '\\pm'      => '±',
            '\\le'      => '≤',
            '\\leq'     => '≤',
            '\\ge'      => '≥',
            '\\geq'     => '≥',
            '\\ne'      => '≠',
            '\\neq'     => '≠',
            '\\approx'  => '≈',
            '\\equiv'   => '≡',
            '\\degree'  => '°',
            '\\alpha'   => 'α',
            '\\beta'    => 'β',
            '\\pi'      => 'π',
            '\\theta'   => 'θ',
            '\\Delta'   => 'Δ',
        ];

        foreach ($parts as $part) {
            if (empty($part)) continue;
            if (str_starts_with(trim($part), '<math')) {
                $out .= $part;
            } else {
                $out .= strtr($part, $replacements);
            }
        }
        return $out;
    }

    /**
     * Convert LaTeX formula to clean MathML for MS Word.
     */
    public static function latexToMathML(string $latex, bool $display = false): string
    {
        $latex = trim($latex);
        if (empty($latex)) {
            return '';
        }

        $latex = html_entity_decode($latex, ENT_QUOTES, 'UTF-8');

        // Parse LaTeX tokens into MathML XML
        $body = self::parseLatexTokens($latex);

        $attr = 'xmlns="http://www.w3.org/1998/Math/MathML"';
        if ($display) {
            $attr .= ' display="block"';
        }
        return '<math ' . $attr . '><mrow>' . $body . '</mrow></math>';
    }

    /**
     * Parse LaTeX tokens recursively into MathML elements.
     */
    protected static function parseLatexTokens(string $tex): string
    {
        // 1. Spacing
        $tex = preg_replace('/\\\\[,;: ]/', '<mspace width="0.2em"/>', $tex);
        $tex = preg_replace('/\\\\(quad|qquad|enspace)/', '<mspace width="1em"/>', $tex);

        // 2. Delimiters
        $tex = str_replace(['\left\{', '\{'], '<mo>{</mo>', $tex);
        $tex = str_replace(['\right\}', '\}'], '<mo>}</mo>', $tex);
        $tex = str_replace('\left(', '<mo>(</mo>', $tex);
        $tex = str_replace('\right)', '<mo>)</mo>', $tex);
        $tex = str_replace('\left[', '<mo>[</mo>', $tex);
        $tex = str_replace('\right]', '<mo>]</mo>', $tex);
        $tex = str_replace('\left|', '<mo>|</mo>', $tex);
        $tex = str_replace('\right|', '<mo>|</mo>', $tex);
        $tex = str_replace(['\left.', '\right.'], '', $tex);

        // 3. Fractions: \frac{num}{den} or \dfrac{num}{den}
        $patternFrac = '/\\\\d?frac\{((?:[^{}]+|(?R))*)\}\{((?:[^{}]+|(?R))*)\}/s';
        while (preg_match($patternFrac, $tex)) {
            $tex = preg_replace_callback($patternFrac, function ($m) {
                $num = self::parseLatexTokens($m[1]);
                $den = self::parseLatexTokens($m[2]);
                return '<mfrac><mrow>' . $num . '</mrow><mrow>' . $den . '</mrow></mfrac>';
            }, $tex);
        }

        // 4. Roots: \sqrt[n]{x} or \sqrt{x}
        $tex = preg_replace_callback('/\\\\sqrt\[(.*?)\]\{((?:[^{}]+|(?R))*)\}/s', function ($m) {
            $deg = self::parseLatexTokens($m[1]);
            $rad = self::parseLatexTokens($m[2]);
            return '<mroot><mrow>' . $rad . '</mrow><mrow>' . $deg . '</mrow></mroot>';
        }, $tex);

        $patternSqrt = '/\\\\sqrt\{((?:[^{}]+|(?R))*)\}/s';
        while (preg_match($patternSqrt, $tex)) {
            $tex = preg_replace_callback($patternSqrt, function ($m) {
                $rad = self::parseLatexTokens($m[1]);
                return '<msqrt><mrow>' . $rad . '</mrow></msqrt>';
            }, $tex);
        }

        // 5. Superscripts: ^{...} or ^x
        $tex = preg_replace_callback('/([a-zA-Z0-9\)\}\]]|<mo>.*?<\/mo>)\^\{([^}]+)\}/', function ($m) {
            $base = self::wrapToken($m[1]);
            $exp = self::parseLatexTokens($m[2]);
            return '<msup>' . $base . '<mrow>' . $exp . '</mrow></msup>';
        }, $tex);
        $tex = preg_replace_callback('/([a-zA-Z0-9\)\}\]]|<mo>.*?<\/mo>)\^([a-zA-Z0-9])/', function ($m) {
            $base = self::wrapToken($m[1]);
            $exp = self::wrapToken($m[2]);
            return '<msup>' . $base . $exp . '</msup>';
        }, $tex);

        // 6. Subscripts: _{...} or _x
        $tex = preg_replace_callback('/([a-zA-Z0-9\)\}\]]|<mo>.*?<\/mo>)_\{([^}]+)\}/', function ($m) {
            $base = self::wrapToken($m[1]);
            $sub = self::parseLatexTokens($m[2]);
            return '<msub>' . $base . '<mrow>' . $sub . '</mrow></msub>';
        }, $tex);
        $tex = preg_replace_callback('/([a-zA-Z0-9\)\}\]]|<mo>.*?<\/mo>)_([a-zA-Z0-9])/', function ($m) {
            $base = self::wrapToken($m[1]);
            $sub = self::wrapToken($m[2]);
            return '<msub>' . $base . $sub . '</msub>';
        }, $tex);

        // 7. Symbol mappings using placeholders
        $symbols = [
            '\\in'       => '<mo>&#x2208;</mo>', // ∈
            '\\notin'    => '<mo>&#x2209;</mo>', // ∉
            '\\subset'   => '<mo>&#x2282;</mo>', // ⊂
            '\\subseteq' => '<mo>&#x2286;</mo>', // ⊆
            '\\cap'      => '<mo>&#x2229;</mo>', // ∩
            '\\cup'      => '<mo>&#x222A;</mo>', // ∪
            '\\emptyset' => '<mo>&#x2205;</mo>', // ∅
            '\\times'    => '<mo>&#x00D7;</mo>', // ×
            '\\cdot'     => '<mo>&#x22C5;</mo>', // ⋅
            '\\div'      => '<mo>&#x00F7;</mo>', // ÷
            '\\pm'       => '<mo>&#x00B1;</mo>', // ±
            '\\mp'       => '<mo>&#x2213;</mo>', // ∓
            '\\le'       => '<mo>&#x2264;</mo>', // ≤
            '\\leq'      => '<mo>&#x2264;</mo>', // ≤
            '\\ge'       => '<mo>&#x2265;</mo>', // ≥
            '\\geq'      => '<mo>&#x2265;</mo>', // ≥
            '\\ne'       => '<mo>&#x2260;</mo>', // ≠
            '\\neq'      => '<mo>&#x2260;</mo>', // ≠
            '\\approx'   => '<mo>&#x2248;</mo>', // ≈
            '\\equiv'    => '<mo>&#x2261;</mo>', // ≡
            '\\infty'    => '<mo>&#x221E;</mo>', // ∞
            '\\degree'   => '<mo>&#x00B0;</mo>', // °
            '\\alpha'    => '<mi>&#x03B1;</mi>', // α
            '\\beta'     => '<mi>&#x03B2;</mi>', // β
            '\\pi'       => '<mi>&#x03C0;</mi>', // π
            '\\theta'    => '<mi>&#x03B8;</mi>', // θ
            '\\Delta'    => '<mo>&#x0394;</mo>', // Δ
            '\\log'      => '<mo>log</mo>',
            '\\sin'      => '<mo>sin</mo>',
            '\\cos'      => '<mo>cos</mo>',
            '\\tan'      => '<mo>tan</mo>',
            '\\lim'      => '<mo>lim</mo>',
        ];

        $phIndex = 0;
        $placeholders = [];
        foreach ($symbols as $cmd => $xml) {
            if (strpos($tex, $cmd) !== false) {
                $ph = "___SYM{$phIndex}___";
                $placeholders[$ph] = $xml;
                $tex = str_replace($cmd, $ph, $tex);
                $phIndex++;
            }
        }

        // 8. Tokenize remaining characters (preserve existing XML tags and placeholders)
        $parts = preg_split('/(<[^>]+>|___SYM\d+___)/s', $tex, -1, PREG_SPLIT_DELIM_CAPTURE);
        $result = '';
        foreach ($parts as $part) {
            if (empty($part)) continue;
            if (str_starts_with($part, '<') && str_ends_with($part, '>')) {
                $result .= $part;
            } elseif (isset($placeholders[$part])) {
                $result .= $placeholders[$part];
            } else {
                $len = strlen($part);
                $i = 0;
                while ($i < $len) {
                    $c = $part[$i];
                    if (ctype_digit($c)) {
                        $num = '';
                        while ($i < $len && (ctype_digit($part[$i]) || $part[$i] === '.')) {
                            $num .= $part[$i];
                            $i++;
                        }
                        $result .= '<mn>' . $num . '</mn>';
                    } elseif (ctype_alpha($c)) {
                        $result .= '<mi>' . $c . '</mi>';
                        $i++;
                    } elseif (in_array($c, ['+', '-', '=', '<', '>', '*', '/', '(', ')', '[', ']', '{', '}', '!', '|', ':', ';', ','])) {
                        $op = ($c === '<') ? '&lt;' : (($c === '>') ? '&gt;' : $c);
                        $result .= '<mo>' . $op . '</mo>';
                        $i++;
                    } elseif (ctype_space($c)) {
                        $i++;
                    } else {
                        $result .= '<mo>' . htmlspecialchars($c, ENT_QUOTES, 'UTF-8') . '</mo>';
                        $i++;
                    }
                }
            }
        }

        return $result;
    }

    protected static function wrapToken(string $token): string
    {
        if (str_starts_with($token, '<') && str_ends_with($token, '>')) {
            return $token;
        }
        if (ctype_digit($token)) {
            return '<mn>' . $token . '</mn>';
        }
        if (ctype_alpha($token)) {
            return '<mi>' . $token . '</mi>';
        }
        return '<mo>' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '</mo>';
    }
}
