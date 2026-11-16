<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('website-utama', 'WebsiteUtama::index');
$routes->get('website-utama/(:any)', 'WebsiteUtama::index/$1');
$routes->get('auth', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('auth/login', 'Auth::index');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('useradmin/profile', 'Useradmin::profile');
$routes->get('useradmin/gantipassword', 'Useradmin::gantipassword');
$routes->get('gantipassword', 'Useradmin::gantipassword');
$routes->get('profile', 'Useradmin::profile');
$routes->get('dashboard/getlog', 'Dashboard::getLog');
$routes->get('dashboard/hapuslog/(:any)', 'Dashboard::hapusLog/$1');
$routes->get('dashboard/getpost', 'Dashboard::getpost');
$routes->get('dashboard/getjadwalhariini/(:any)/(:any)', 'Dashboard::getJadwalHariIni/$1/$2');
$routes->get('dashboard/getjadwalcbt/(:any)/(:any)', 'Dashboard::getJadwalCbt/$1/$2');

// Datatahun
$routes->get('datatahun', 'Datatahun::index');
$routes->post('datatahun/data', 'Datatahun::data');
$routes->post('datatahun/gantitahun', 'Datatahun::gantiTahun');
$routes->post('datatahun/gantisemester', 'Datatahun::gantiSemester');
$routes->post('datatahun/add', 'Datatahun::add');
$routes->post('datatahun/hapustahun', 'Datatahun::hapusTahun');
$routes->post('datatahun/savehariefektif', 'Datatahun::saveHariEfektif');

// Datajurusan
$routes->get('datajurusan', 'Datajurusan::index');
$routes->post('datajurusan/data', 'Datajurusan::data');
$routes->post('datajurusan/save', 'Datajurusan::save');
$routes->post('datajurusan/delete', 'Datajurusan::delete');
$routes->get('datajurusan/load_jurusan', 'Datajurusan::load_jurusan');
$routes->match(['GET', 'POST'], 'datajurusan/import', 'Datajurusan::import');
$routes->post('datajurusan/do_import', 'Datajurusan::do_import');

// Datamapel
$routes->get('datamapel', 'Datamapel::index');
$routes->post('datamapel/read', 'Datamapel::read');
$routes->post('datamapel/create', 'Datamapel::create');
$routes->post('datamapel/update', 'Datamapel::update');
$routes->post('datamapel/delete', 'Datamapel::delete');
$routes->post('datamapel/getdatakelompok', 'Datamapel::getDataKelompok');
// Datamapel
$routes->get('datamapel', 'Datamapel::index');
$routes->post('datamapel/read', 'Datamapel::read');
$routes->post('datamapel/create', 'Datamapel::create');
$routes->post('datamapel/update', 'Datamapel::update');
$routes->post('datamapel/delete', 'Datamapel::delete');
$routes->post('datamapel/getdatakelompok', 'Datamapel::getDataKelompok');
$routes->post('datamapel/getdatasubkelompok', 'Datamapel::getDataSubKelompok');
$routes->post('datamapel/addkelompokmapel', 'Datamapel::addKelompokMapel');
$routes->post('datamapel/hapuskelompok', 'Datamapel::hapusKelompok');
$routes->get('datamapel/aktifkan/(:segment)', 'Datamapel::aktifkan/$1');
$routes->match(['GET', 'POST'], 'datamapel/import', 'Datamapel::import');
$routes->post('datamapel/do_import', 'Datamapel::do_import');

// Datajurusan additions
$routes->post('datajurusan/add', 'Datajurusan::save');
$routes->post('datajurusan/update', 'Datajurusan::save');

// Dataekstra
$routes->get('dataekstra', 'Dataekstra::index');
$routes->match(['GET', 'POST'], 'dataekstra/read', 'Dataekstra::read');
$routes->post('dataekstra/create', 'Dataekstra::create');
$routes->post('dataekstra/update', 'Dataekstra::update');
$routes->match(['GET', 'POST'], 'dataekstra/delete/(:segment)', 'Dataekstra::delete/$1');
$routes->post('dataekstra/delete_batch', 'Dataekstra::delete_batch');
$routes->get('dataekstra/detail/(:segment)', 'Dataekstra::detail/$1');
$routes->post('dataekstra/save', 'Dataekstra::save');

// Datakelas
$routes->get('datakelas', 'Datakelas::index');
$routes->post('datakelas/data', 'Datakelas::data');
$routes->get('datakelas/detail/(:segment)', 'Datakelas::detail/$1');
$routes->get('datakelas/add', 'Datakelas::add');
$routes->get('datakelas/edit/(:segment)', 'Datakelas::edit/$1');
$routes->post('datakelas/save', 'Datakelas::save');
$routes->match(['GET', 'POST'], 'datakelas/hapus', 'Datakelas::hapus');
$routes->match(['GET', 'POST'], 'datakelas/hapus/(:any)', 'Datakelas::hapus/$1');
$routes->get('datakelas/getfromsmt1/(:any)', 'Datakelas::getFromSmt1/$1');
$routes->post('datakelas/update_kelas/(:any)', 'Datakelas::update_kelas/$1');
$routes->post('datakelas/bulk_create', 'Datakelas::bulk_create');
$routes->match(['GET', 'POST'], 'datakelas/kenaikan', 'Datakelas::kenaikan');
$routes->match(['GET', 'POST'], 'datakelas/kenaikan/(:any)', 'Datakelas::kenaikan/$1');
$routes->post('datakelas/naikkelas', 'Datakelas::naikKelas');
$routes->post('datakelas/naikkan_semua', 'Datakelas::naikkan_semua');
$routes->match(['GET', 'POST'], 'datakelas/manage', 'Datakelas::manage');
$routes->match(['GET', 'POST'], 'datakelas/persemester', 'Datakelas::persemester');
$routes->post('datakelas/copyfromsmt1', 'Datakelas::copyFromSmt1');
$routes->post('datakelas/copyallsiswa', 'Datakelas::copySiswaFromSmt1');
$routes->post('datakelas/copykelasbefore', 'Datakelas::copyKelasBefore');
$routes->post('datakelas/copyallfromsmt1', 'Datakelas::copyAllFromSmt1');

// Dataguru routes
$routes->get('dataguru', 'Dataguru::index');
$routes->get('dataguru/add', 'Dataguru::add');
$routes->get('dataguru/update', 'Dataguru::update');
$routes->post('dataguru/create', 'Dataguru::create');
$routes->get('dataguru/edit/(:segment)', 'Dataguru::edit/$1');
$routes->post('dataguru/save', 'Dataguru::save');
$routes->post('dataguru/updatedata', 'Dataguru::updateData');
$routes->post('dataguru/hapus', 'Dataguru::hapus');
$routes->match(['GET', 'POST'], 'dataguru/import', 'Dataguru::import');
$routes->post('dataguru/do_import', 'Dataguru::do_import');
$routes->get('dataguru/data', 'Dataguru::data');
$routes->get('dataguru/detail/(:num)', 'Dataguru::detail/$1');
$routes->get('dataguru/kartu/semua', 'Kartuguru::semua');
$routes->get('dataguru/kartu/(:num)', 'Kartuguru::show/$1');
$routes->post('dataguru/delete', 'Dataguru::delete');
$routes->post('dataguru/forcedelete', 'Dataguru::forceDelete');
$routes->post('dataguru/deleteguru', 'Dataguru::deleteGuru');
$routes->match(['GET', 'POST'], 'dataguru/editjabatan/(:num)', 'Dataguru::editJabatan/$1');
$routes->match(['GET', 'POST'], 'dataguru/editJabatan/(:num)', 'Dataguru::editJabatan/$1');
$routes->post('dataguru/savejabatan', 'Dataguru::saveJabatan');
$routes->post('dataguru/saveJabatan', 'Dataguru::saveJabatan');
$routes->get('dataguru/getdatakelas', 'Dataguru::getDataKelas');
$routes->get('dataguru/getDataKelas', 'Dataguru::getDataKelas');
$routes->match(['GET', 'POST'], 'dataguru/addjabatan', 'Dataguru::addjabatan');
$routes->match(['GET', 'POST'], 'dataguru/addJabatan', 'Dataguru::addjabatan');
$routes->get('dataguru/downloaddata', 'Dataguru::downloadData');
$routes->get('dataguru/template', 'Dataguru::template');
$routes->get('dataguru/template_word', 'Dataguru::template_word');
$routes->get('dataguru/template_update', 'Dataguru::template_update');
$routes->post('dataguru/update_all', 'Dataguru::update_all');
$routes->post('dataguru/update_foto', 'Dataguru::update_foto');

// Datasiswa
$routes->get('datasiswa', 'Datasiswa::index');
$routes->get('datasiswa/template', 'Datasiswa::template');
$routes->get('datasiswa/template_update', 'Datasiswa::template_update');
$routes->post('datasiswa/list', 'Datasiswa::list');
$routes->post('datasiswa/data', 'Datasiswa::list');
$routes->get('datasiswa/add', 'Datasiswa::add');
$routes->get('datasiswa/add/(:segment)', 'Datasiswa::add/$1');
$routes->get('datasiswa/update', 'Datasiswa::update');
$routes->get('datasiswa/update/(:segment)', 'Datasiswa::update/$1');
$routes->post('datasiswa/create', 'Datasiswa::create');
$routes->get('datasiswa/edit/(:segment)', 'Datasiswa::edit/$1');
$routes->post('datasiswa/save', 'Datasiswa::save');
$routes->post('datasiswa/updatedata', 'Datasiswa::updateData');
$routes->post('datasiswa/hapus', 'Datasiswa::hapus');
$routes->post('datasiswa/delete', 'Datasiswa::hapus');
$routes->post('datasiswa/do_import', 'Datasiswa::do_import');
$routes->get('datasiswa/downloaddata/(:segment)', 'Datasiswa::downloadData/$1');
$routes->get('datasiswa/kartu/semua', 'Kartusiswa::semua');
$routes->get('datasiswa/kartu/(:num)', 'Kartusiswa::show/$1');
$routes->get('datasiswa/export_excel', 'Datasiswa::exportExcel');
$routes->post('datasiswa/updateall', 'Datasiswa::updateAll');
$routes->post('datasiswa/update_foto', 'Datasiswa::updateFoto');
$routes->post('datasiswa/editlogin', 'Datasiswa::editLogin');
$routes->post('datasiswa/updateNisByNisn', 'Datasiswa::updateNisByNisn');
$routes->match(['GET', 'POST'], 'datasiswa/uploadfile/(:num)', 'Datasiswa::uploadFile/$1');
$routes->match(['GET', 'POST'], 'datasiswa/uploadFile/(:num)', 'Datasiswa::uploadFile/$1');
$routes->match(['GET', 'POST'], 'datasiswa/deletefile/(:num)', 'Datasiswa::deleteFile/$1');
$routes->match(['GET', 'POST'], 'datasiswa/deleteFile/(:num)', 'Datasiswa::deleteFile/$1');

// Buku Induk (Siswa dan Guru)

// Guru Profile (member)
$routes->get('guru', 'Guru::index');
$routes->get('guru/profile', 'Guru::index');
$routes->get('guru/getpost', 'Guru::getpost');
$routes->post('guru/save', 'Guru::save');
$routes->match(['GET', 'POST'], 'guru/uploadFile/(:num)', 'Guru::uploadFile/$1');
$routes->match(['GET', 'POST'], 'guru/uploadfile/(:num)', 'Guru::uploadFile/$1');
$routes->match(['GET', 'POST'], 'guru/deleteFile/(:num)', 'Guru::deleteFile/$1');
$routes->match(['GET', 'POST'], 'guru/deletefile/(:num)', 'Guru::deleteFile/$1');
$routes->get('guru/delete_dokumen/(:num)', 'Guru::delete_dokumen/$1');

// Settings
$routes->get('settings', 'Settings::index');
$routes->get('settings/dbmanager', 'Settings::dbManager');
$routes->post('settings/saveSetting', 'Settings::saveSetting');
$routes->post('settings/uploadFile/(:any)', 'Settings::uploadFile/$1');
$routes->post('settings/deleteFile', 'Settings::deleteFile');

// Patch & Update Manager
$routes->get('patch', 'Patch::index');
$routes->post('patch/preview', 'Patch::preview');
$routes->post('patch/apply', 'Patch::apply');
$routes->post('patch/rollback', 'Patch::rollback');
$routes->get('patch/download_backup/(:any)', 'Patch::downloadBackup/$1');
$routes->post('patch/delete_backup', 'Patch::deleteBackup');
$routes->post('patch/create', 'Patch::createPatch');
$routes->get('patch/download_generated/(:any)', 'Patch::downloadGenerated/$1');


// User Admin
$routes->get('useradmin', 'Useradmin::data');
$routes->get('useradmin/edit/(:num)', 'Useradmin::edit/$1');
$routes->post('useradmin/create', 'Useradmin::create');
$routes->post('useradmin/edit_info', 'Useradmin::edit_info');
$routes->post('useradmin/edit_status', 'Useradmin::edit_status');
$routes->post('useradmin/edit_level', 'Useradmin::edit_level');
$routes->post('datasiswa/data', 'Datasiswa::list');
$routes->get('datasiswa/add', 'Datasiswa::add');
$routes->get('datasiswa/add/(:segment)', 'Datasiswa::add/$1');
$routes->get('datasiswa/update', 'Datasiswa::update');
$routes->get('datasiswa/update/(:segment)', 'Datasiswa::update/$1');
$routes->post('datasiswa/create', 'Datasiswa::create');
$routes->get('datasiswa/edit/(:segment)', 'Datasiswa::edit/$1');
$routes->post('datasiswa/save', 'Datasiswa::save');
$routes->post('datasiswa/hapus', 'Datasiswa::hapus');
$routes->post('datasiswa/delete', 'Datasiswa::hapus');
$routes->post('datasiswa/do_import', 'Datasiswa::do_import');
$routes->get('datasiswa/downloaddata/(:segment)', 'Datasiswa::downloadData/$1');
$routes->get('datasiswa/kartu/semua', 'Kartusiswa::semua');
$routes->get('datasiswa/kartu/(:num)', 'Kartusiswa::show/$1');
$routes->get('datasiswa/export_excel', 'Datasiswa::exportExcel');
$routes->post('datasiswa/updateall', 'Datasiswa::updateAll');
$routes->post('datasiswa/update_foto', 'Datasiswa::updateFoto');
$routes->post('datasiswa/editlogin', 'Datasiswa::editLogin');
$routes->post('datasiswa/updateNisByNisn', 'Datasiswa::updateNisByNisn');
$routes->post('datasiswa/uploadfile/(:num)', 'Datasiswa::uploadFile/$1');
$routes->get('datasiswa/deletefile/(:num)', 'Datasiswa::deleteFile/$1');

// Guru Profile (member)
$routes->get('guru', 'Guru::index');
$routes->get('guru/profile', 'Guru::index');
$routes->get('guru/getpost', 'Guru::getpost');
$routes->post('guru/save', 'Guru::save');
$routes->post('guru/uploadFile/(:num)', 'Guru::uploadFile/$1');
$routes->get('guru/deleteFile/(:num)', 'Guru::deleteFile/$1');
$routes->get('guru/delete_dokumen/(:num)', 'Guru::delete_dokumen/$1');


// Settings
$routes->get('settings', 'Settings::index');
$routes->get('settings/dbmanager', 'Settings::dbManager');
$routes->post('settings/saveSetting', 'Settings::saveSetting');
$routes->post('settings/uploadFile/(:any)', 'Settings::uploadFile/$1');
$routes->post('settings/deleteFile', 'Settings::deleteFile');

// User Admin
$routes->get('useradmin', 'Useradmin::data');
$routes->get('useradmin/edit/(:num)', 'Useradmin::edit/$1');
$routes->post('useradmin/create', 'Useradmin::create');
$routes->post('useradmin/edit_info', 'Useradmin::edit_info');
$routes->post('useradmin/edit_status', 'Useradmin::edit_status');
$routes->post('useradmin/edit_level', 'Useradmin::edit_level');
$routes->post('useradmin/change_password', 'Useradmin::change_password');
$routes->get('useradmin/delete/(:num)', 'Useradmin::delete/$1');
$routes->post('useradmin/uploadFile/(:num)', 'Useradmin::uploadFile/$1');
$routes->post('useradmin/saveProfile', 'Useradmin::saveProfile');
$routes->post('useradmin/saveprofile', 'Useradmin::saveProfile');
$routes->post('useradmin/deleteFile', 'Useradmin::deleteFile');
$routes->post('useradmin/deletefile', 'Useradmin::deleteFile');

// User Guru
$routes->get('userguru', 'Userguru::index');
$routes->get('userguru/data', 'Userguru::data');
$routes->get('userguru/edit/(:num)', 'Userguru::edit/$1');
$routes->post('userguru/activate', 'Userguru::activate');
$routes->post('userguru/aktifkanSemua', 'Userguru::aktifkanSemua');
$routes->post('userguru/aktifkansemua', 'Userguru::aktifkanSemua');
$routes->get('userguru/update_iduser', 'Userguru::update_iduser');
$routes->post('userguru/editLogin', 'Userguru::editLogin');
$routes->post('userguru/editlogin', 'Userguru::editLogin');
$routes->post('userguru/reset_login', 'Userguru::reset_login');

// User Siswa
$routes->get('usersiswa', 'Usersiswa::index');
$routes->post('usersiswa/list', 'Usersiswa::list');
$routes->post('usersiswa/activate', 'Usersiswa::activate');
$routes->post('usersiswa/aktifkanSemua', 'Usersiswa::aktifkanSemua');
$routes->post('usersiswa/reset_login', 'Usersiswa::reset_login');

// Profil Sekolah
$routes->get('sekolah', 'Settings::index');
$routes->post('sekolah/savesetting', 'Settings::saveSetting');
$routes->post('sekolah/uploadfile/(:any)', 'Settings::uploadFile/$1');
$routes->post('sekolah/deletefile', 'Settings::deleteFile');

// Database Management
$routes->get('dbmanager', 'Settings::dbManager');
$routes->match(['get', 'post'], 'dbmanager/backupdb', 'Settings::backupDb');
$routes->match(['get', 'post'], 'dbmanager/backupdata', 'Settings::backupData');
$routes->match(['get', 'post'], 'dbmanager/del_backup', 'Settings::delBackup');
$routes->match(['get', 'post'], 'dbmanager/hapusbackup/(:any)', 'Settings::hapusBackup/$1');
$routes->match(['get', 'post'], 'dbmanager/download/(:any)', 'Settings::download/$1');
$routes->post('dbmanager/restore_file', 'Settings::restoreExistingFile');
$routes->post('dbmanager/upload_restore', 'Settings::uploadAndRestore');
$routes->match(['get', 'post'], 'settings/backupdb', 'Settings::backupDb');
$routes->match(['get', 'post'], 'settings/backupdata', 'Settings::backupData');
$routes->post('settings/restore_file', 'Settings::restoreExistingFile');
$routes->post('settings/upload_restore', 'Settings::uploadAndRestore');
$routes->get('dbclear', 'Dbclear::index');
$routes->post('dbclear/hapusTable', 'Dbclear::hapusTable');
$routes->post('dbclear/hapustable', 'Dbclear::hapusTable');
$routes->post('dbclear/dropTable', 'Dbclear::dropTable');
$routes->post('dbclear/droptable', 'Dbclear::dropTable');
$routes->post('dbclear/clearModule', 'Dbclear::clearModule');
$routes->post('dbclear/clearmodule', 'Dbclear::clearModule');
$routes->get('dbclear/truncate', 'Dbclear::truncate');

// Converter
$routes->get('dbconvert', 'Dbconvert::index');
$routes->post('dbconvert/convert', 'Dbconvert::convert');
$routes->match(['GET', 'POST'], 'dbconvert/status', 'Dbconvert::status');

// Pengumuman
$routes->get('pengumuman', 'Pengumuman::index');
$routes->get('pengumuman/kepada/(:any)', 'Pengumuman::kepada/$1');
$routes->get('pengumuman/kepada/(:any)/(:num)', 'Pengumuman::kepada/$1/$2');
$routes->get('pengumuman/getpost', 'Pengumuman::getPost');
$routes->get('pengumuman/getpost/(:num)', 'Pengumuman::getPost/$1');
$routes->get('pengumuman/getcomment/(:num)/(:num)', 'Pengumuman::getComment/$1/$2');
$routes->get('pengumuman/getcomments/(:num)/(:num)', 'Pengumuman::getComments/$1/$2');
$routes->get('pengumuman/getreplies/(:num)/(:num)', 'Pengumuman::getReplies/$1/$2');
$routes->post('pengumuman/save', 'Pengumuman::save');
$routes->post('pengumuman/savekomentar', 'Pengumuman::saveKomentar');
$routes->post('pengumuman/savebalasan', 'Pengumuman::saveBalasan');
$routes->match(['get', 'post'], 'pengumuman/hapuspost/(:num)', 'Pengumuman::hapusPost/$1');
$routes->match(['get', 'post'], 'pengumuman/hapuskomentar/(:num)', 'Pengumuman::hapusKomentar/$1');
$routes->match(['get', 'post'], 'pengumuman/hapusbalasan/(:num)', 'Pengumuman::hapusBalasan/$1');
$routes->get('pengumuman/getrunningtext', 'Pengumuman::getRunningText');
$routes->post('pengumuman/saverunningtext', 'Pengumuman::saveRunningText');
$routes->match(['get', 'post'], 'pengumuman/hapusrunningtext/(:num)', 'Pengumuman::hapusRunningText/$1');

// Banner Slider Siswa
$routes->get('banner', 'Banner::index');
$routes->post('banner/save', 'Banner::save');
$routes->match(['GET', 'POST'], 'banner/delete/(:num)', 'Banner::delete/$1');
$routes->match(['GET', 'POST'], 'banner/delete', 'Banner::delete');
$routes->match(['GET', 'POST'], 'banner/toggle/(:num)', 'Banner::toggle/$1');
$routes->match(['GET', 'POST'], 'banner/toggle', 'Banner::toggle');

// Datalogs
$routes->get('datalogs', 'Datalogs::index');
$routes->get('datalogs/getlog', 'Datalogs::getlog');
$routes->get('datalogs/hapuslog/(:any)', 'Datalogs::hapuslog/$1');






// Wali Kelas
$routes->get('walisiswa', 'Walisiswa::index');
$routes->post('walisiswa/list', 'Walisiswa::list');
$routes->get('walisiswa/datakelas', 'Walisiswa::dataKelas');
$routes->get('walisiswa/edit/(:num)', 'Walisiswa::edit/$1');
$routes->post('walisiswa/updatedata', 'Walisiswa::updateData');
$routes->post('walisiswa/uploadfile/(:num)', 'Walisiswa::uploadFile/$1');
$routes->get('walisiswa/deletefile/(:num)', 'Walisiswa::deleteFile/$1');
$routes->post('walisiswa/delete', 'Walisiswa::delete');

$routes->get('walistruktur', 'Walistruktur::index');
$routes->post('walistruktur/save', 'Walistruktur::save');

$routes->get('walicatatan', 'Walicatatan::index');
$routes->get('walicatatan/siswa', 'Walicatatan::siswa');
$routes->post('walicatatan/savecatatankelas', 'Walicatatan::saveCatatanKelas');
$routes->post('walicatatan/savecatatansiswa', 'Walicatatan::saveCatatanSiswa');
$routes->get('walicatatan/hapus/(:num)', 'Walicatatan::hapus/$1');

// Kelas Catatan
$routes->get('kelascatatan', 'Kelascatatan::index');
$routes->get('kelascatatan/siswa', 'Kelascatatan::siswa');
$routes->post('kelascatatan/savecatatankelas', 'Kelascatatan::saveCatatanKelas');
$routes->post('kelascatatan/savecatatansiswa', 'Kelascatatan::saveCatatanSiswa');
$routes->get('kelascatatan/hapus/(:num)', 'Kelascatatan::hapus/$1');

// Member Siswa — Siswa controller (catatan, perpus, upload)
$routes->get('siswa/getpost', 'Siswa::getpost');
$routes->get('siswa/get_badge_notifikasi', 'Siswa::get_badge_notifikasi');
$routes->get('siswa/catatan', 'Siswa::catatan');
$routes->match(['get', 'post'], 'siswa/perpus', 'Siswa::perpus');
$routes->match(['get', 'post'], 'siswa/perpustakaan', 'Siswa::perpustakaan');
$routes->get('siswa/catatan/detail/(:segment)/(:segment)', 'Siswa::detailCatatan/$1/$2');
$routes->match(['get', 'post'], 'siswa/detailcatatan/(:segment)/(:segment)', 'Siswa::detailCatatan/$1/$2');
$routes->match(['get', 'post'], 'siswa/catatan/readed/(:segment)/(:segment)', 'Siswa::readed/$1/$2');
$routes->match(['get', 'post'], 'siswa/readed/(:segment)/(:segment)', 'Siswa::readed/$1/$2');
$routes->get('siswa/getcomment/(:num)/(:num)', 'Siswa::getComment/$1/$2');
$routes->get('siswa/getcomments/(:num)/(:num)', 'Siswa::getComments/$1/$2');
$routes->get('siswa/getreplies/(:num)/(:num)', 'Siswa::getReplies/$1/$2');
$routes->post('siswa/savekomentar', 'Siswa::saveKomentar');
$routes->post('siswa/savebalasan', 'Siswa::saveBalasan');
$routes->post('siswa/uploadfile', 'Siswa::uploadFile');
$routes->post('siswa/deletefile', 'Siswa::deleteFile');
$routes->get('siswa/gettimer/(:segment)/(:segment)', 'Siswa::getTimer/$1/$2');


// Member Siswa — CBT
$routes->get('cbtsiswa/cbt', 'Cbtsiswa::cbt');
$routes->get('cbtsiswa/get_cbt_siswa', 'Cbtsiswa::get_cbt_siswa');
$routes->get('cbtsiswa/konfirmasi/(:segment)', 'Cbtsiswa::konfirmasi/$1');
$routes->post('cbtsiswa/validasi_siswa', 'Cbtsiswa::validasi_siswa');
$routes->get('cbtsiswa/penilaian/(:segment)', 'Cbtsiswa::penilaian/$1');
$routes->post('cbtsiswa/validasi_jadwal', 'Cbtsiswa::validasi_jadwal');
$routes->post('cbtsiswa/save_played', 'Cbtsiswa::save_played');
$routes->post('cbtsiswa/loadNomorSoal', 'Cbtsiswa::loadNomorSoal');
$routes->post('cbtsiswa/loadnomorsoal', 'Cbtsiswa::loadNomorSoal');
$routes->post('cbtsiswa/saveJawaban', 'Cbtsiswa::saveJawaban');
$routes->post('cbtsiswa/savejawaban', 'Cbtsiswa::saveJawaban');
$routes->post('cbtsiswa/selesaiUjian', 'Cbtsiswa::selesaiUjian');
$routes->post('cbtsiswa/selesaiujian', 'Cbtsiswa::selesaiUjian');
$routes->post('cbtsiswa/leavecbt', 'Cbtsiswa::leavecbt');
$routes->post('cbtsiswa/hitung_pelanggaran', 'Cbtsiswa::hitung_pelanggaran');
$routes->match(['get', 'post'], 'cbtsiswa/ping_kamera', 'Cbtsiswa::ping_kamera');
$routes->post('cbtsiswa/upload_kamera_frame', 'Cbtsiswa::upload_kamera_frame');

// ===== CBT Bank Soal =====
$routes->get('cbtbanksoal', 'CbtBankSoal::index');
$routes->get('cbtbanksoal/addBank', 'CbtBankSoal::addBank');
$routes->get('cbtbanksoal/addbank', 'CbtBankSoal::addBank');
$routes->get('cbtbanksoal/editBank', 'CbtBankSoal::editBank');
$routes->get('cbtbanksoal/editbank', 'CbtBankSoal::editBank');
$routes->post('cbtbanksoal/saveBank', 'CbtBankSoal::saveBank');
$routes->post('cbtbanksoal/savebank', 'CbtBankSoal::saveBank');
$routes->get('cbtbanksoal/deleteBank', 'CbtBankSoal::deleteBank');
$routes->get('cbtbanksoal/deletebank', 'CbtBankSoal::deleteBank');
$routes->post('cbtbanksoal/deleteAllBank', 'CbtBankSoal::deleteAllBank');
$routes->post('cbtbanksoal/deleteallbank', 'CbtBankSoal::deleteAllBank');
$routes->get('cbtbanksoal/detail/(:num)', 'CbtBankSoal::detail/$1');
$routes->post('cbtbanksoal/get_detail', 'CbtBankSoal::get_detail');
$routes->get('cbtbanksoal/buatsoal/(:num)', 'CbtBankSoal::buatsoal/$1');
$routes->post('cbtbanksoal/saveSoal', 'CbtBankSoal::saveSoal');
$routes->post('cbtbanksoal/savesoal', 'CbtBankSoal::saveSoal');
$routes->post('cbtbanksoal/hapusSoal', 'CbtBankSoal::hapusSoal');
$routes->post('cbtbanksoal/hapussoal', 'CbtBankSoal::hapusSoal');
$routes->post('cbtbanksoal/tambahSoal', 'CbtBankSoal::tambahSoal');
$routes->post('cbtbanksoal/tambahsoal', 'CbtBankSoal::tambahSoal');
$routes->get('cbtbanksoal/get_soals/(:num)', 'CbtBankSoal::get_soals/$1');
$routes->get('cbtbanksoal/getSoalByNomor', 'CbtBankSoal::getSoalByNomor');
$routes->get('cbtbanksoal/getsoalbynomor', 'CbtBankSoal::getSoalByNomor');
$routes->post('cbtbanksoal/saveSelected', 'CbtBankSoal::saveSelected');
$routes->post('cbtbanksoal/saveselected', 'CbtBankSoal::saveSelected');
$routes->post('cbtbanksoal/resetNumber', 'CbtBankSoal::resetNumber');
$routes->post('cbtbanksoal/resetnumber', 'CbtBankSoal::resetNumber');
$routes->get('cbtbanksoal/copyBankSoal/(:num)', 'CbtBankSoal::copyBankSoal/$1');
$routes->get('cbtbanksoal/copybanksoal/(:num)', 'CbtBankSoal::copyBankSoal/$1');
$routes->get('cbtbanksoal/importsoal/(:num)', 'CbtBankSoal::importsoal/$1');
$routes->get('cbtbanksoal/importSoal/(:num)', 'CbtBankSoal::importsoal/$1');
$routes->post('cbtbanksoal/uploadSoal', 'CbtBankSoal::uploadSoal');
$routes->post('cbtbanksoal/uploadsoal', 'CbtBankSoal::uploadSoal');
$routes->post('cbtbanksoal/uploadsoalimage', 'CbtBankSoal::uploadSoalImage');
$routes->post('cbtbanksoal/uploadSoalImage', 'CbtBankSoal::uploadSoalImage');
$routes->get('cbtbanksoal/downloadsoal/(:num)', 'CbtBankSoal::downloadSoal/$1');
$routes->get('cbtbanksoal/downloadSoal/(:num)', 'CbtBankSoal::downloadSoal/$1');
$routes->get('cbtbanksoal/cetaksoal/(:num)', 'CbtBankSoal::cetakSoal/$1');
$routes->get('cbtbanksoal/cetakSoal/(:num)', 'CbtBankSoal::cetakSoal/$1');
$routes->match(['get', 'post'], 'cbtbanksoal/getSoalSiswa/(:num)', 'CbtBankSoal::getSoalSiswa/$1');
$routes->match(['get', 'post'], 'cbtbanksoal/getsoalsiswa/(:num)', 'CbtBankSoal::getSoalSiswa/$1');
// AJAX endpoints — sinkronisasi Guru & Kelas
$routes->get('cbtbanksoal/getgurumapel', 'CbtBankSoal::getgurumapel');
$routes->get('cbtbanksoal/getkelaslevel', 'CbtBankSoal::getkelaslevel');
$routes->get('cbtbanksoal/getSyncMapel', 'CbtBankSoal::getSyncMapel');
$routes->match(['get', 'post'], 'cbtbanksoal/syncToUjian/(:num)', 'CbtBankSoal::syncToUjian/$1');
$routes->match(['get', 'post'], 'cbtbanksoal/synctoujian/(:num)', 'CbtBankSoal::syncToUjian/$1');
$routes->match(['get', 'post'], 'cbtbanksoal/syncToUjian', 'CbtBankSoal::syncToUjian');
$routes->match(['get', 'post'], 'cbtbanksoal/synctoujian', 'CbtBankSoal::syncToUjian');

// ===== CBT Cetak =====
$routes->get('cbtcetak', 'Cbtcetak::index');
$routes->get('cbtcetak/kartupeserta', 'Cbtcetak::kartuPeserta');
$routes->post('cbtcetak/savekartu', 'Cbtcetak::saveKartu');
$routes->post('cbtcetak/savekop', 'Cbtcetak::saveKop');
$routes->post('cbtcetak/uploadfile/(:any)', 'Cbtcetak::uploadFile/$1');
$routes->post('cbtcetak/deletefile', 'Cbtcetak::deleteFile');
$routes->get('cbtcetak/absenpeserta', 'Cbtcetak::absenPeserta');
$routes->get('cbtcetak/beritaacara', 'Cbtcetak::beritaAcara');
$routes->post('cbtcetak/savekopberita', 'Cbtcetak::saveKopBerita');
$routes->post('cbtcetak/savekoppengawas', 'Cbtcetak::saveKopPengawas');
$routes->post('cbtcetak/savekoppeserta', 'Cbtcetak::saveKopPeserta');
$routes->get('cbtcetak/pesertaujian/(:any)', 'Cbtcetak::pesertaUjian/$1');
$routes->get('cbtcetak/pesertaujian', 'Cbtcetak::pesertaUjian');
$routes->get('cbtcetak/susulan', 'Cbtcetak::susulan');
$routes->get('cbtcetak/pengawas', 'Cbtcetak::pengawas');
$routes->get('cbtcetak/getkelas', 'Cbtcetak::getKelas');
$routes->get('cbtcetak/getruang', 'Cbtcetak::getRuang');
$routes->get('cbtcetak/getalljadwal', 'Cbtcetak::getAllJadwal');
$routes->get('cbtcetak/getjadwalmapel', 'Cbtcetak::getJadwalMapel');
$routes->get('cbtcetak/getsiswaruang', 'Cbtcetak::getSiswaRuang');
$routes->get('cbtcetak/getsiswakelas', 'Cbtcetak::getSiswaKelas');
$routes->get('cbtcetak/jadwal', 'Cbtcetak::index');

// ===== CBT Jadwal =====
$routes->get('cbtjadwal', 'CbtJadwal::index');
$routes->get('cbtjadwal/add', 'CbtJadwal::add');
$routes->get('cbtjadwal/add/(:num)', 'CbtJadwal::add/$1');
$routes->get('cbtjadwal/getbankmapel/(:any)', 'CbtJadwal::getBankMapel/$1');
$routes->get('cbtjadwal/getBankMapel/(:any)', 'CbtJadwal::getBankMapel/$1');
$routes->get('cbtjadwal/getbankmapel', 'CbtJadwal::getBankMapel');
$routes->get('cbtjadwal/getBankMapel', 'CbtJadwal::getBankMapel');
$routes->post('cbtjadwal/savejadwal', 'CbtJadwal::saveJadwal');
$routes->post('cbtjadwal/saveJadwal', 'CbtJadwal::saveJadwal');
$routes->post('cbtjadwal/aktifkan_jadwal', 'CbtJadwal::aktifkan_jadwal');
$routes->get('cbtjadwal/deletejadwal', 'CbtJadwal::deleteJadwal');
$routes->get('cbtjadwal/deleteJadwal', 'CbtJadwal::deleteJadwal');
$routes->post('cbtjadwal/deletealljadwal', 'CbtJadwal::deleteAllJadwal');
$routes->post('cbtjadwal/deleteAllJadwal', 'CbtJadwal::deleteAllJadwal');
$routes->match(['get', 'post'], 'cbtjadwal/get_all_norekap', 'CbtJadwal::get_all_norekap');
$routes->post('cbtjadwal/toggleaksesguru', 'CbtJadwal::toggleAksesGuru');
$routes->post('cbtjadwal/toggleAksesGuru', 'CbtJadwal::toggleAksesGuru');

// ===== CBT Status (Monitor Ujian, Reset Izin, Hitung Pelanggaran) =====
$routes->get('cbtstatus', 'Cbtstatus::index');
$routes->get('cbtstatus/getjadwalujianbyjadwal', 'Cbtstatus::getJadwalUjianByJadwal');
$routes->get('cbtstatus/getJadwalUjianByJadwal', 'Cbtstatus::getJadwalUjianByJadwal');
$routes->get('cbtstatus/gettgljadwalujian', 'Cbtstatus::getTglJadwalUjian');
$routes->get('cbtstatus/getTglJadwalUjian', 'Cbtstatus::getTglJadwalUjian');
$routes->get('cbtstatus/getjadwalujianbykelas', 'Cbtstatus::getJadwalUjianByKelas');
$routes->get('cbtstatus/getJadwalUjianByKelas', 'Cbtstatus::getJadwalUjianByKelas');
$routes->get('cbtstatus/getstatussiswa', 'Cbtstatus::getStatusSiswa');
$routes->get('cbtstatus/getStatusSiswa', 'Cbtstatus::getStatusSiswa');
$routes->get('cbtstatus/getsiswakelas', 'Cbtstatus::getSiswaKelas');
$routes->get('cbtstatus/getSiswaKelas', 'Cbtstatus::getSiswaKelas');
$routes->get('cbtstatus/getsiswaruang', 'Cbtstatus::getSiswaRuang');
$routes->get('cbtstatus/getSiswaRuang', 'Cbtstatus::getSiswaRuang');
$routes->post('cbtstatus/applyaction', 'Cbtstatus::applyAction');
$routes->post('cbtstatus/applyAction', 'Cbtstatus::applyAction');
$routes->post('cbtstatus/resettimer', 'Cbtstatus::resetTimer');
$routes->post('cbtstatus/resetTimer', 'Cbtstatus::resetTimer');
$routes->post('siswa/applyaction', 'Cbtstatus::applyAction');
$routes->post('siswa/applyAction', 'Cbtstatus::applyAction');
$routes->post('siswa/resettimer', 'Cbtstatus::resetTimer');
$routes->post('siswa/resetTimer', 'Cbtstatus::resetTimer');
$routes->get('cbtstatus/pengawas', 'Cbtstatus::pengawas');
$routes->get('cbtstatus/getstatusruang', 'Cbtstatus::get_status_ruang');
$routes->match(['get', 'post'], 'cbtstatus/get_exit_code', 'Cbtstatus::get_exit_code');
$routes->match(['get', 'post'], 'cbtstatus/generate_exit_code', 'Cbtstatus::generate_exit_code');
$routes->match(['get', 'post'], 'cbtstatus/verify_exit_code', 'Cbtstatus::verify_exit_code');
$routes->match(['get', 'post'], 'cbtstatus/request_pantau', 'Cbtstatus::request_pantau');
$routes->match(['get', 'post'], 'cbtstatus/get_pantau_frame', 'Cbtstatus::get_pantau_frame');
$routes->match(['get', 'post'], 'cbtstatus/stop_pantau', 'Cbtstatus::stop_pantau');

// ===== CBT Token (Gunakan Token) =====
$routes->get('cbttoken', 'CbtToken::index');
$routes->match(['get', 'post'], 'cbttoken/simpantoken', 'CbtToken::generateToken');
$routes->match(['get', 'post'], 'cbttoken/simpanToken', 'CbtToken::generateToken');
$routes->match(['get', 'post'], 'cbttoken/generatetoken', 'CbtToken::generateToken');
$routes->match(['get', 'post'], 'cbttoken/generatetoken/', 'CbtToken::generateToken');
$routes->match(['get', 'post'], 'cbttoken/generateToken', 'CbtToken::generateToken');
$routes->match(['get', 'post'], 'cbttoken/generateToken/', 'CbtToken::generateToken');
$routes->get('cbttoken/loadtoken', 'CbtToken::loadToken');
$routes->get('cbttoken/loadToken', 'CbtToken::loadToken');
$routes->match(['get', 'post'], 'cbttoken/checktokenjadwal', 'CbtToken::checkTokenJadwal');

// ===== CBT Exambro Setting =====
$routes->get('cbtexambro', 'CbtExambro::index');
$routes->post('cbtexambro/save', 'CbtExambro::save');
$routes->match(['get', 'post'], 'cbttoken/checkTokenJadwal', 'CbtToken::checkTokenJadwal');
$routes->match(['get', 'post'], 'dashboard/checktokenjadwal', 'Dashboard::checkTokenJadwal');
$routes->match(['get', 'post'], 'dashboard/checkTokenJadwal', 'Dashboard::checkTokenJadwal');

// ===== CBT Aktivasi (Aktifkan Ujian per Sesi) =====
$routes->get('cbtactivate', 'Cbtactivate::index');
$routes->get('cbtactivate/data', 'Cbtactivate::data');
$routes->post('cbtactivate/aktifkan_semua', 'Cbtactivate::aktifkan_semua');
$routes->post('cbtactivate/aktifkan_sesi', 'Cbtactivate::aktifkan_sesi');
$routes->get('cbtactivate/getsiswaruang', 'Cbtactivate::getSiswaRuang');

// ===== CBT Alokasi =====
$routes->get('cbtalokasi', 'CbtAlokasi::index');
$routes->match(['get', 'post'], 'cbtalokasi/detail', 'CbtAlokasi::detail');
$routes->match(['get', 'post'], 'cbtalokasi/detail/(:any)', 'CbtAlokasi::detail/$1');
$routes->post('cbtalokasi/savealokasi', 'CbtAlokasi::saveAlokasi');
$routes->post('cbtalokasi/saveAlokasi', 'CbtAlokasi::saveAlokasi');
$routes->get('cbtalokasi/get_tanggal', 'CbtAlokasi::get_tanggal');
$routes->post('cbtalokasi/get_alokasi', 'CbtAlokasi::get_alokasi');

// ===== CBT Nilai =====
$routes->get('cbtnilai', 'Cbtnilai::index');
$routes->get('cbtnilai/koreksi', 'Cbtnilai::koreksi');
$routes->get('cbtnilai/detail', 'Cbtnilai::detail');
$routes->get('cbtnilai/detail/(:any)', 'Cbtnilai::detail/$1');
$routes->get('cbtnilai/inputessai', 'Cbtnilai::inputEssai');
$routes->get('cbtnilai/inputEssai', 'Cbtnilai::inputEssai');
$routes->post('cbtnilai/getnilaisiswa', 'Cbtnilai::get_nilai_siswa');
$routes->post('cbtnilai/get_nilai_siswa', 'Cbtnilai::get_nilai_siswa');
$routes->post('cbtnilai/savepengurangan', 'Cbtnilai::save_pengurangan');
$routes->post('cbtnilai/savePengurangan', 'Cbtnilai::save_pengurangan');
$routes->match(['get', 'post'], 'cbtnilai/mark_all', 'Cbtnilai::mark_all');
$routes->match(['get', 'post'], 'cbtnilai/tandaisemua', 'Cbtnilai::mark_all');
$routes->match(['get', 'post'], 'cbtnilai/tandaikoreksi', 'Cbtnilai::tandaikoreksi');
$routes->match(['get', 'post'], 'cbtnilai/simpankoreksi', 'Cbtnilai::simpankoreksi');
$routes->match(['get', 'post'], 'cbtnilai/get_koreksi', 'Cbtnilai::get_koreksi');
$routes->match(['get', 'post'], 'cbtnilai/simpannilaiinput', 'Cbtnilai::simpanNilaiInput');
$routes->match(['get', 'post'], 'cbtnilai/simpanNilaiInput', 'Cbtnilai::simpanNilaiInput');

// ===== CBT Rekap =====
$routes->get('cbtrekap', 'Cbtrekap::index');
$routes->get('cbtrekap/rekap', 'Cbtrekap::rekap');
$routes->get('cbtrekap/koreksi', 'Cbtrekap::koreksi');
$routes->get('cbtrekap/inputessai', 'Cbtrekap::inputEssai');
$routes->get('cbtrekap/inputEssai', 'Cbtrekap::inputEssai');
$routes->get('cbtrekap/olahnilai', 'Cbtrekap::rekap_nilai');
$routes->get('cbtrekap/export_all', 'Cbtrekap::export_all');
$routes->post('cbtrekap/hapusrekap', 'Cbtrekap::hapusRekap');
$routes->post('cbtrekap/hapusRekap', 'Cbtrekap::hapusRekap');
$routes->match(['get', 'post'], 'cbtrekap/getnilaikelas', 'Cbtrekap::getNilaiKelas');
$routes->match(['get', 'post'], 'cbtrekap/getNilaiKelas', 'Cbtrekap::getNilaiKelas');
$routes->post('cbtrekap/ekpsorekap', 'Cbtrekap::ekspor_rekap');
$routes->post('cbtrekap/getnilaisiswa', 'Cbtrekap::rekap_nilai_siswa');
$routes->post('cbtrekap/getnilaiekspor', 'Cbtrekap::get_nilai_rekap');
$routes->post('cbtrekap/get_nilai_rekap', 'Cbtrekap::get_nilai_rekap');
$routes->post('cbtrekap/getupdated', 'Cbtrekap::get_updated');
$routes->get('cbtrekap/getnilaisiswa', 'Cbtrekap::rekap_nilai_siswa');
$routes->get('cbtrekap/getnilaiekspor', 'Cbtrekap::get_nilai_rekap');

// ===== CBT Analisis =====
$routes->get('cbtanalisis', 'Cbtanalisis::index');
$routes->get('cbtanalisis/analisis', 'Cbtanalisis::analisis');
$routes->get('cbtanalisis/getjadwalujianbyjadwal', 'Cbtanalisis::getJadwalUjianByJadwal');
$routes->get('cbtanalisis/getnilaikelas', 'Cbtanalisis::getNilaiKelas');
$routes->get('cbtanalisis/kalkulasi', 'Cbtanalisis::kalkulasi');
$routes->post('cbtanalisis/saranai', 'Cbtanalisis::saranAi');
$routes->post('cbtanalisis/updatesoal', 'Cbtanalisis::updateSoal');

// ===== CBT Sesi =====
$routes->get('cbtsesi', 'CbtSesi::index');
$routes->match(['get', 'post'], 'cbtsesi/data', 'CbtSesi::data');
$routes->match(['get', 'post'], 'cbtsesi/add', 'CbtSesi::add');
$routes->match(['get', 'post'], 'cbtsesi/update', 'CbtSesi::update');
$routes->match(['get', 'post'], 'cbtsesi/delete', 'CbtSesi::delete');
$routes->match(['get', 'post'], 'cbtsesi/(:segment)', 'CbtSesi::$1');

// ===== CBT Ruang =====
$routes->get('cbtruang', 'CbtRuang::index');
$routes->match(['get', 'post'], 'cbtruang/data', 'CbtRuang::data');
$routes->match(['get', 'post'], 'cbtruang/add', 'CbtRuang::add');
$routes->match(['get', 'post'], 'cbtruang/update', 'CbtRuang::update');
$routes->match(['get', 'post'], 'cbtruang/save', 'CbtRuang::add');
$routes->match(['get', 'post'], 'cbtruang/delete', 'CbtRuang::delete');
$routes->match(['get', 'post'], 'cbtruang/(:segment)', 'CbtRuang::$1');

// ===== CBT Nomor Peserta =====
$routes->get('cbtnomorpeserta', 'CbtNomorPeserta::index');
$routes->match(['get', 'post'], 'cbtnomorpeserta/getsiswakelas', 'CbtNomorPeserta::getSiswaKelas');
$routes->match(['get', 'post'], 'cbtnomorpeserta/resetnomor', 'CbtNomorPeserta::resetNomor');
$routes->match(['get', 'post'], 'cbtnomorpeserta/savenomor', 'CbtNomorPeserta::saveNomor');
$routes->match(['get', 'post'], 'cbtnomorpeserta/(:segment)', 'CbtNomorPeserta::$1');

// ===== CBT Jenis =====
$routes->get('cbtjenis', 'CbtJenis::index');
$routes->match(['get', 'post'], 'cbtjenis/data', 'CbtJenis::data');
$routes->match(['get', 'post'], 'cbtjenis/add', 'CbtJenis::add');
$routes->match(['get', 'post'], 'cbtjenis/update', 'CbtJenis::update');
$routes->match(['get', 'post'], 'cbtjenis/save', 'CbtJenis::add');
$routes->match(['get', 'post'], 'cbtjenis/delete', 'CbtJenis::delete');
$routes->match(['get', 'post'], 'cbtjenis/(:segment)', 'CbtJenis::$1');

// ===== CBT Pengawas =====
$routes->get('cbtpengawas', 'CbtPengawas::index');
$routes->match(['get', 'post'], 'cbtpengawas/get_tanggal', 'CbtPengawas::get_tanggal');
$routes->match(['get', 'post'], 'cbtpengawas/get_pengawas', 'CbtPengawas::get_pengawas');
$routes->match(['get', 'post'], 'cbtpengawas/savepengawas', 'CbtPengawas::savePengawas');
$routes->match(['get', 'post'], 'cbtpengawas/save', 'CbtPengawas::savePengawas');
$routes->match(['get', 'post'], 'cbtpengawas/(:segment)', 'CbtPengawas::$1');

// ===== CBT Sesi Siswa =====
$routes->get('cbtsesisiswa', 'CbtSesiSiswa::index');
$routes->match(['get', 'post'], 'cbtsesisiswa/editsesisiswa', 'CbtSesiSiswa::editsesisiswa');
$routes->match(['get', 'post'], 'cbtsesisiswa/resetsesisiswa', 'CbtSesiSiswa::resetsesisiswa');
$routes->match(['get', 'post'], 'cbtsesisiswa/(:segment)', 'CbtSesiSiswa::$1');

// ===== CBT Analisis (Duplicate removed/unified) =====
$routes->get('cbtanalisis/getNilaiKelas', 'Cbtanalisis::getNilaiKelas');
$routes->get('cbtanalisis/getJadwalUjianByJadwal', 'Cbtanalisis::getJadwalUjianByJadwal');

$routes->get('cbtrekap', 'Cbtrekap::index');
$routes->get('cbtrekap/get_count', 'Cbtrekap::get_count');
$routes->get('cbtrekap/get_jadwal', 'Cbtrekap::get_jadwal');
$routes->get('cbtrekap/get_rekap', 'Cbtrekap::get_rekap');
$routes->post('cbtrekap/rekap', 'Cbtrekap::rekap');
$routes->post('cbtrekap/rekap_nilai_siswa', 'Cbtrekap::rekap_nilai_siswa');
$routes->post('cbtrekap/delete_rekap', 'Cbtrekap::delete_rekap');
$routes->get('cbtrekap/export_all', 'Cbtrekap::export_all');
$routes->get('cbtrekap/ekspor_rekap', 'Cbtrekap::ekspor_rekap');
$routes->match(['GET', 'POST'], 'cron/whatsapp-queue', 'Whatsapp::processQueue');



// ===== Bukurapor (Kumpulan Nilai Rapor) =====
$routes->get('bukurapor', 'Bukurapor::index');
$routes->get('bukurapor/getdatakelas', 'Bukurapor::getDataKelas');
$routes->get('bukurapor/getraporsiswalengkap/(:num)/(:num)', 'Bukurapor::getRaporSiswaLengkap/$1/$2');

// ===== Rapor =====
$routes->get('rapor', 'Rapor::index');
$routes->get('rapor/mapel', 'Rapor::mapel');
$routes->get('rapor/mapel/(:any)', 'Rapor::mapel/$1');
$routes->post('rapor/savemapelrapor', 'Rapor::saveMapelRapor');
$routes->post('rapor/syncmapelujian', 'Rapor::syncMapelUjian');
$routes->post('rapor/resetstandarmts', 'Rapor::resetStandarMts');
$routes->post('rapor/saverapoRadmin', 'Rapor::saveRaporAdmin');
$routes->post('rapor/saveraporadmin', 'Rapor::saveRaporAdmin');
$routes->get('rapor/raporkkm', 'Rapor::raporkkm');
$routes->get('rapor/getkktp/(:any)/(:any)', 'Rapor::getKktp/$1/$2');
$routes->post('rapor/savekktp', 'Rapor::saveKktp');
$routes->get('rapor/raporkikd', 'Rapor::raporkikd');
$routes->get('rapor/gettplist/(:any)/(:any)', 'Rapor::getTpList/$1/$2');
$routes->post('rapor/savetp', 'Rapor::saveTp');
$routes->post('rapor/deletetp/(:any)', 'Rapor::deleteTp/$1');
$routes->get('rapor/datakikd/(:any)/(:any)', 'Rapor::datakikd/$1/$2');
$routes->post('rapor/savekikd', 'Rapor::saveKikd');

$routes->get('rapor/rapornilai', 'Rapor::raporNilai');
$routes->get('rapor/rapornilai/(:any)', 'Rapor::raporNilai/$1');
$routes->get('rapor/inputsas/(:any)/(:any)', 'Rapor::inputSas/$1/$2');
$routes->post('rapor/savenilaipts', 'Rapor::saveNilaiPts');
$routes->post('rapor/savenilaisas', 'Rapor::saveNilaiSas');
$routes->post('rapor/tariknilaicbt', 'Rapor::tarikNilaiCbt');
$routes->post('rapor/savenilaiasesmen', 'Rapor::saveNilaiAsesmen');
$routes->post('rapor/savep5', 'Rapor::saveP5');
$routes->post('rapor/savekemenagkegiatan', 'Rapor::saveKemenagKegiatan');
$routes->post('rapor/deletekemenagkegiatan', 'Rapor::deleteKemenagKegiatan');
$routes->get('rapor/getkemenagnilai/(:num)', 'Rapor::getKemenagNilai/$1');
$routes->post('rapor/savekemenagnilai', 'Rapor::saveKemenagNilai');
$routes->post('rapor/togglekemenagkirim', 'Rapor::toggleKemenagKirim');
$routes->post('rapor/savekehadirancatatan', 'Rapor::saveKehadiranCatatan');
$routes->get('rapor/getraporsiswalengkap/(:any)/(:any)', 'Rapor::getRaporSiswaLengkap/$1/$2');
$routes->get('rapor/cetaksampul/(:any)/(:any)', 'Rapor::cetakSampul/$1/$2');
$routes->get('rapor/cetakidentitas/(:any)/(:any)', 'Rapor::cetakIdentitas/$1/$2');
$routes->get('rapor/cetakakhir/(:any)', 'Rapor::cetakAkhir/$1');
$routes->get('rapor/cetakpts/(:any)', 'Rapor::cetakPts/$1');
$routes->get('rapor/rapornilaiguru', 'Rapor::raporNilaiGuru');
$routes->get('rapor/rapornilaiGuru/(:any)', 'Rapor::raporNilaiGuru/$1');
$routes->get('rapor/rapornilaiGuru/(:any)/(:any)', 'Rapor::raporNilaiGuru/$1/$2');
$routes->get('rapor/raporceknilai', 'Rapor::raporCekNilai');
$routes->get('rapor/raporceknilai/(:any)', 'Rapor::raporCekNilai/$1');
$routes->get('rapor/raporceknilai/(:any)/(:any)', 'Rapor::raporCekNilai/$1/$2');
// Input Nilai Harian
$routes->get('rapor/inputharian/(:any)/(:any)', 'Rapor::inputHarian/$1/$2');
$routes->get('rapor/downloadnilaiharian/(:any)/(:any)', 'Rapor::downloadNilaiHarian/$1/$2');
$routes->post('rapor/uploadnilaiharian', 'Rapor::uploadNilaiHarian');
$routes->post('rapor/importharian', 'Rapor::importHarian');
// Input Nilai PTS
$routes->get('rapor/inputpts/(:any)/(:any)', 'Rapor::inputPts/$1/$2');
$routes->get('rapor/downloadtemplatepts/(:any)/(:any)', 'Rapor::downloadTemplatePts/$1/$2');
$routes->post('rapor/uploadnilaipts', 'Rapor::uploadNilaiPts');
$routes->post('rapor/importpts', 'Rapor::importPts');
// Input Nilai PAS
$routes->get('rapor/inputpas/(:any)/(:any)', 'Rapor::inputPas/$1/$2');
$routes->get('rapor/downloadtemplatepas/(:any)/(:any)', 'Rapor::downloadTemplatePas/$1/$2');
$routes->post('rapor/uploadnilaipas', 'Rapor::uploadNilaiPas');
$routes->post('rapor/importpas', 'Rapor::importPas');
// Input Nilai Ekstra
$routes->get('rapor/inputekstra/(:any)/(:any)', 'Rapor::inputEkstra/$1/$2');
$routes->get('rapor/downloadtemplateekstra/(:any)/(:any)', 'Rapor::downloadTemplateEkstra/$1/$2');
$routes->post('rapor/uploadnilaiekstra', 'Rapor::uploadNilaiEkstra');
$routes->post('rapor/importekstra', 'Rapor::importEkstra');
// Sikap, Spiritual, Sosial
$routes->get('rapor/raporsikap', 'Rapor::raporSikap');
$routes->post('rapor/savesikap', 'Rapor::saveSikap');
$routes->get('rapor/raporspiritual', 'Rapor::raporSpiritual');
$routes->post('rapor/importspiritual/(:any)', 'Rapor::importSpiritual/$1');
$routes->get('rapor/raporsosial', 'Rapor::raporSosial');
$routes->post('rapor/importsosial/(:any)', 'Rapor::importSosial/$1');
// Prestasi, Catatan, Fisik
$routes->get('rapor/raporprestasi', 'Rapor::raporPrestasi');
$routes->post('rapor/saveprestasi', 'Rapor::savePrestasi');
$routes->post('rapor/importprestasi/(:any)', 'Rapor::importPrestasi/$1');
$routes->get('rapor/raporcatatan', 'Rapor::raporCatatan');
$routes->post('rapor/savecatatan', 'Rapor::saveCatatan');
$routes->post('rapor/importcatatan/(:any)', 'Rapor::importCatatan/$1');
$routes->get('rapor/raporfisik', 'Rapor::raporFisik');
$routes->post('rapor/savefisik', 'Rapor::saveFisik');
$routes->post('rapor/importfisik/(:any)', 'Rapor::importFisik/$1');
// Kenaikan, Cetak, Leger, DKN
$routes->get('rapor/rapornaik', 'Rapor::raporNaik');
$routes->post('rapor/savenaik', 'Rapor::saveNaik');
$routes->get('rapor/cetakpts', 'Rapor::cetakPts');
$routes->get('rapor/cetakakhir', 'Rapor::cetakAkhir');
$routes->get('rapor/cetakleger', 'Rapor::cetakLeger');
$routes->get('rapor/cetakleger/(:any)', 'Rapor::cetakLeger/$1');
$routes->get('rapor/leger', 'Rapor::cetakLeger');
$routes->get('rapor/leger/(:any)', 'Rapor::cetakLeger/$1');
$routes->get('rapor/cetakranking', 'Rapor::cetakRanking');
$routes->get('rapor/cetakranking/(:any)', 'Rapor::cetakRanking/$1');
$routes->get('rapor/ranking', 'Rapor::cetakRanking');
$routes->get('rapor/ranking/(:any)', 'Rapor::cetakRanking/$1');
$routes->get('rapor/kikd', 'Rapor::raporkikd');
$routes->get('rapor/tp', 'Rapor::raporkikd');
$routes->get('rapor/kkm', 'Rapor::raporkkm');
$routes->get('rapor/kktp', 'Rapor::raporkkm');
$routes->get('rapor/nilai', 'Rapor::raporNilai');
$routes->get('rapor/sikap', 'Rapor::raporSikap');
$routes->get('rapor/p5', 'Rapor::raporSikap');
$routes->get('rapor/catatan', 'Rapor::raporCatatan');
$routes->get('rapor/akhir', 'Rapor::cetakAkhir');
$routes->get('rapor/pts', 'Rapor::cetakPts');
$routes->get('rapor/sts', 'Rapor::cetakPts');
$routes->get('rapor/downloadleger', 'Rapor::downloadLeger');
$routes->get('rapor/dkn', 'Rapor::dkn');

// ===== Buku Rapor =====
$routes->get('bukurapor', 'Bukurapor::index');
$routes->get('bukurapor/getdatakelas', 'Bukurapor::getDataKelas');
$routes->post('bukurapor/backupnilai', 'Bukurapor::backupNilai');
$routes->post('bukurapor/restorenilai', 'Bukurapor::restoreNilai');
$routes->get('bukurapor/edit', 'Bukurapor::edit');
$routes->get('bukurapor/ledger', 'Bukurapor::ledger');
$routes->get('bukurapor/dkn', 'Bukurapor::dkn');

// ===== Data Alumni =====
$routes->get('dataalumni', 'Dataalumni::index');
$routes->get('dataalumni/generatealumni', 'Dataalumni::generateAlumni');
$routes->post('dataalumni/luluskankelas', 'Dataalumni::luluskanKelas');
$routes->get('dataalumni/excel', 'Dataalumni::excel');
$routes->get('dataalumni/cetak', 'Dataalumni::cetak');
$routes->get('dataalumni/detail/(:num)', 'Dataalumni::detail/$1');
$routes->get('dataalumni/add', 'Dataalumni::add');
$routes->post('dataalumni/create', 'Dataalumni::create');
$routes->get('dataalumni/edit', 'Dataalumni::edit');
$routes->post('dataalumni/batalkan', 'Dataalumni::batalkan');
$routes->post('dataalumni/updatedata', 'Dataalumni::updateData');
$routes->post('dataalumni/delete', 'Dataalumni::delete');
$routes->post('dataalumni/do_import', 'Dataalumni::do_import');
$routes->post('dataalumni/editkelulusan', 'Dataalumni::editKelulusan');
$routes->post('dataalumni/editKelulusan', 'Dataalumni::editKelulusan');

// ===== Gemini AI Generator (Terisolasi & Mandiri) =====
$routes->get('aigenerator', 'AiGenerator::index');
$routes->get('aigenerator/status', 'AiGenerator::status');
$routes->get('aigenerator/listmodels', 'AiGenerator::listmodels');
$routes->post('aigenerator/savekey', 'AiGenerator::savekey');
$routes->post('aigenerator/testkey', 'AiGenerator::testkey');
$routes->post('aigenerator/generatesoal', 'AiGenerator::generatesoal');
$routes->post('aigenerator/generatemateri', 'AiGenerator::generatemateri');
$routes->post('aigenerator/generateimage', 'AiGenerator::generateimage');
$routes->post('aigenerator/savecanvasimage', 'AiGenerator::savecanvasimage');

// ===== Documentation =====
$routes->get('Doc', 'Doc::index');
$routes->get('doc', 'Doc::index');

// =============================================
// INSTALLER & UPDATER ROUTES
// =============================================
$routes->match(['get', 'post'], 'install', 'Install::index');
$routes->match(['get', 'post'], 'install/step', 'Install::step');
$routes->match(['get', 'post'], 'install/checkdatabase', 'Install::checkDatabase');
$routes->match(['get', 'post'], 'install/create', 'Install::create');
$routes->match(['get', 'post'], 'install/createapp', 'Install::createApp');

$routes->get('update', 'Update::index');
$routes->get('update/checkdatabase', 'Update::checkDatabase');
$routes->get('update/updatedatabase', 'Update::updateDatabase');
$routes->post('update', 'Update::postUpdate');

// =============================================
// REST API NATIVE ANDROID MEMBER SISWA (v1)
// =============================================
$routes->group('api/v1/siswa', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    $routes->match(['get', 'post', 'options'], 'ping', 'SiswaApi::ping');
    $routes->match(['get', 'post', 'options'], 'login', 'SiswaApi::login');
    $routes->match(['get', 'post', 'options'], 'logout', 'SiswaApi::logout');
    $routes->match(['get', 'post', 'options'], 'dashboard', 'SiswaApi::dashboard');
    // CBT Native Endpoints
    $routes->match(['get', 'post', 'options'], 'cbt/jadwal', 'SiswaApi::cbt_jadwal');
    $routes->match(['get', 'post', 'options'], 'cbt/mulai', 'SiswaApi::cbt_mulai');
    $routes->match(['get', 'post', 'options'], 'cbt/simpan-jawaban', 'SiswaApi::cbt_simpan_jawaban');
    $routes->match(['get', 'post', 'options'], 'cbt/selesai', 'SiswaApi::cbt_selesai');
    $routes->match(['get', 'post', 'options'], 'cbt/pelanggaran', 'SiswaApi::cbt_pelanggaran');
    $routes->match(['get', 'post', 'options'], 'cbt/leave', 'SiswaApi::cbt_leave');
    $routes->match(['get', 'post', 'options'], 'cbt/verify-exit', 'SiswaApi::cbt_verify_exit');
    $routes->match(['get', 'post', 'options'], 'cbt/kamera-frame', 'SiswaApi::cbt_kamera_frame');
});

