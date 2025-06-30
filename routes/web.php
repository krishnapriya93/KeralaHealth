<?php

use App\Http\Controllers\AcsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SiteadminController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\KaleidoscopeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::fallback(function () {
    return response()->view('backend.error.404', [], 404);
});
/* FrontEnd */

Route::get('/', [FrontendController::class, 'index'])->name('main.index');
// Route::get('/home', [FrontendController::class, 'index'])->name('home');
Route::get('/announcement', [FrontendController::class, 'announcement'])->name('main.announcement');
Route::get('/departmentlist', [FrontendController::class, 'department_list'])->name('main.departmentlist');
Route::get('/orgnazationlistdetail', [FrontendController::class, 'orgnazationlistdetail'])->name('main.orgnazationlistdetail');
Route::get('/whatsnewmain', [FrontendController::class, 'whats'])->name('main.whatsnewmain');
Route::get('/whatsnew/{id}', [FrontendController::class, 'whatsnew'])->name('main.whatsnew');
Route::get('/dobmessage-detail/{id}', [FrontendController::class, 'dobmessage_detail'])->name('main.dobmessage-detail');
Route::get('/department-details/{title}/{id}', [FrontendController::class, 'department_details'])->name('main.department-details');
Route::get('/sdg', [FrontendController::class, 'sdg'])->name('main.sdg');
Route::get('/news-detail', [FrontendController::class, 'news_detail'])->name('main.news-detail');
Route::post('/officeSeldepCat', [FrontendController::class, 'officeSeldepCat'])->name('officeSeldepCat');
Route::post('/officeSelorgCat', [FrontendController::class, 'officeSelorgCat'])->name('officeSelorgCat');
Route::get('/setbilingualvalmal', [FrontendController::class,'setbilingualvalmal'])->name('setbilingualvalmal');
Route::get('/setbilingualval', [FrontendController::class, 'setbilingualval'])->name('setbilingualval');
Route::get('/articledetail/{title}/{id}', [FrontendController::class, 'articledetail'])->name('main.articledetail');
Route::get('/recentarticledetail/{id}', [FrontendController::class, 'recentarticledetail'])->name('main.recentarticledetail');
Route::get('/awarddetails/{title}/{id}', [FrontendController::class, 'awarddetails'])->name('main.awarddetails');
Route::get('/mainarticleview/{id}', [FrontendController::class, 'mainarticleview'])->name('main.mainarticleview');
Route::get('/SchemesProgrammes/{id}', [FrontendController::class, 'SchemesProgrammes'])->name('main.SchemesProgrammes');
Route::get('/SchemesdepartSel', [FrontendController::class, 'SchemesdepartSel'])->name('main.SchemesdepartSel');
Route::get('/schemedetailpage/{id}', [FrontendController::class, 'schemedetailpage'])->name('main.schemedetailpage');
Route::get('/publicregistration', [FrontendController::class, 'publicregistration'])->name('main.publicregistration');
Route::post('/storepublicregistration', [FrontendController::class, 'storepublicregistration'])->name('main.storepublicregistration');
Route::get('/publiclogin', [FrontendController::class, 'publiclogin'])->name('main.publiclogin');
Route::get('publichome', [EditorController::class, 'publichome'])->name('publichome');
Route::get('FinancialAid', [FrontendController::class, 'FinancialAid'])->name('FinancialAid');
Route::get('Publications/{id?}', [FrontendController::class, 'Publications'])->name('Publications');
Route::get('Brouchers/{id?}', [FrontendController::class, 'Brouchers'])->name('Brouchers');
Route::get('Posters/{id?}', [FrontendController::class, 'Posters'])->name('Posters');
Route::get('onlineservices/{id?}', [FrontendController::class, 'onlineservices'])->name('onlineservices');
Route::get('/photogallery', [FrontendController::class, 'photogallery'])->name('/photogallery');
Route::get('/videogallery', [FrontendController::class, 'videogallery'])->name('/videogallery');
Route::get('gallerydetail/{id?}', [FrontendController::class, 'gallerydetail'])->name('main.gallerydetail');
Route::get('/financialaiditem/{id?}', [FrontendController::class, 'financialaiditem'])->name('main.financialaiditem');
Route::get('/financialaiditemPDF/{id?}', [FrontendController::class, 'financialaiditemPDF'])->name('main.financialaiditemPDF');
Route::get('/SchemesMenu/{id?}', [FrontendController::class, 'SchemesMenu'])->name('main.SchemesMenu');
Route::get('/Schemes/{id?}', [FrontendController::class, 'Schemes'])->name('main.Schemes');
Route::get('/scheme-item/{id}/{type}', [FrontendController::class, 'Sechmeitem'])->name('main.Sechmeitem');

Route::get('/ambulancedetails', [FrontendController::class, 'ambulancedetails'])->name('main.ambulancedetails');

Route::get('mainarticle/{articletypeid}', [FrontendController::class, 'mainarticle'])->name('mainarticle');
Route::get('/announcementitem/{id}', [FrontendController::class, 'announcementitem'])->name('main.announcementitem');
Route::get('wellnessdetail/{title}/{id}/{data}', [FrontendController::class, 'wellnessdetail'])->name('wellnessdetail');

Route::get('/healthscapedetail/{title}/{id}', [FrontendController::class, 'healthscapedetail'])->name('main.healthscapedetail');
Route::get('/dashboarddetail', [FrontendController::class, 'dashboarddetail'])->name('main.dashboarddetail');
Route::get('/dashboarddetailnew', [FrontendController::class, 'dashboarddetailnew'])->name('main.dashboarddetailnew');
Route::post('/departmentsort', [FrontendController::class, 'departmentsort'])->name('departmentsort');
Route::post('/orgnazationsort', [FrontendController::class, 'orgnazationsort'])->name('orgnazationsort');

Route::get('/gallery/iecmaterials', [FrontendController::class, 'iecmaterials'])->name('main.iecmaterials');
Route::get('/gallery/iecmaterialsdetail/{id}', [FrontendController::class, 'iecmaterialsdetail'])->name('main.iecmaterialsdetail');

Route::get('login', [LoginController::class, 'loginview'])->name('loginview');
Route::post('checklogins', [LoginController::class, 'checklogin'])->name('checklogins');
Route::get('refreshCaptcha', [LoginController::class, 'refreshCaptcha'])->name('refreshCaptcha');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/articleckimageupload', [CkeditorController::class, 'articleckimageupload'])->name('articleckimageupload');

//kaleidoscope
Route::get('/keralahealth/kaleidoscope', [KaleidoscopeController::class, 'kaleidoscope'])->name('main.kaleidoscope');  
Route::post('/keralahealth/kaleidoscope-children', [KaleidoscopeController::class, 'getKaleidoscopeChildren'])->name('main.kaleidoscope.children');
Route::post('/district/institutions', [KaleidoscopeController::class, 'getInstitutionsByDistrict'])->name('district.institutions');


/*DASHBOARD----GOPIKA*/

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboarddetails', [DashboardController::class, 'dashboarddetails'])->name('dashboarddetails');
Route::get('/birthratedetails', [DashboardController::class, 'birthratedetails'])->name('birthratedetails');
Route::get('/maternalmortalitydetails', [DashboardController::class, 'maternalmortalitydetails'])->name('maternalmortalitydetails');
Route::get('/bedstrength_one_details', [DashboardController::class, 'bedstrength_one_details'])->name('bedstrength_one_details');
Route::get('/bedstrength_two_details', [DashboardController::class, 'bedstrength_two_details'])->name('bedstrength_two_details');
Route::get('/healthindicator_details', [DashboardController::class, 'healthindicator_details'])->name('healthindicator_details');
Route::get('/familyhealth_centersdetails', [DashboardController::class, 'familyhealth_centersdetails'])->name('familyhealth_centersdetails');

// Category wise -25-06-2025

Route::get('/demographics', [DashboardController::class, 'demographics'])->name('demographics');












/* Admin */
Route::group(['middleware' => ['auth', 'App\Http\Middleware\Adminlogin', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('masteradminhome', [AdminController::class, 'masteradminhome'])->name('masteradminhome');

    //Component
    Route::get('/component', [AdminController::class, 'component'])->name('component');
    Route::post('/storecomponent', [AdminController::class, 'storecomponent'])->name('storecomponent');
    Route::get('/editcomponent/{id}', [AdminController::class, 'editcomponent'])->name('editcomponent');
    Route::post('/updatecomponent', [AdminController::class, 'updatecomponent'])->name('updatecomponent');
    Route::get('/deletecomponent/{id}', [AdminController::class, 'deletecomponent'])->name('deletecomponent');
    Route::get('/statuscomponent/{id}', [AdminController::class, 'statuscomponent'])->name('statuscomponent');

    //Component permissions
    Route::get('/componentpermi', [AdminController::class, 'componentpermissions'])->name('componentpermi');
    Route::post('/storecomponentpermi', [App\Http\Controllers\AdminController::class, 'storecomponentpermi'])->name('storecomponentpermi');
    Route::get('/editcomponentper/{id}', [AdminController::class, 'editcomponentper'])->name('editcomponentper');
    Route::post('/updatecomponentperm', [AdminController::class, 'updatecomponentperm'])->name('updatecomponentperm');
    Route::get('/deletecomponentper/{id}', [AdminController::class, 'deletecomponentper'])->name('deletecomponentper');
    Route::get('/statuscomperm/{id}', [AdminController::class, 'statuscomperm'])->name('statuscomperm');

    //Language
    Route::get('/language', [AdminController::class, 'language'])->name('language');
    Route::post('/storelanguage', [AdminController::class, 'storelanguage'])->name('storelanguage');
    Route::get('/editlanguage/{id}', [AdminController::class, 'editlanguage'])->name('editlanguage');
    Route::post('/updatelanguage', [AdminController::class, 'updatelanguage'])->name('updatelanguage');
    Route::get('/deletelanguage/{id}', [AdminController::class, 'deletelanguage'])->name('deletelanguage');
    Route::get('/statuslanguage/{id}', [AdminController::class, 'statuslanguage'])->name('statuslanguage');

    //UserType
    Route::get('/usertype', [AdminController::class, 'usertype'])->name('usertype');
    Route::post('/storeusertype', [AdminController::class, 'storeusertype'])->name('storeusertype');
    Route::get('/editusertype/{id}', [AdminController::class, 'editusertype'])->name('editusertype');
    Route::post('/updateusertype', [AdminController::class, 'updateusertype'])->name('updateusertype');
    Route::get('/deleteusertype/{id}', [AdminController::class, 'deleteusertype'])->name('deleteusertype');
    Route::get('/statususertype/{id}', [AdminController::class, 'statususertype'])->name('statususertype');

    //user
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::post('/storeuser', [AdminController::class, 'storeuser'])->name('storeuser');
    Route::get('/edituser/{id}', [AdminController::class, 'edituser'])->name('edituser');
    Route::post('/updateuser', [AdminController::class, 'updateuser'])->name('updateuser');
    Route::get('/deleteuser/{id}', [AdminController::class, 'deleteuser'])->name('deleteuser');
    Route::get('/statususer/{id}', [AdminController::class, 'statususer'])->name('statususer');
    Route::post('/importuser', [AdminController::class, 'importuser'])->name('importuser');
});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\Masteradminlogin', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('masterhome', [MasterController::class, 'index'])->name('masterhome');

    //Article Type
    Route::get('/masteradmin/articletype', [MasterController::class, 'articletype'])->name('masteradmin.articletype');
    Route::get('/masteradmin/createarticletype', [MasterController::class, 'createarticletype'])->name('masteradmin.createarticletype');
    Route::post('/masteradmin/storearticletype', [MasterController::class, 'storearticletype'])->name('masteradmin.storearticletype');
    Route::get('/masteradmin/editarticletype/{id}', [MasterController::class, 'editarticletype'])->name('masteradmin.editarticletype');
    Route::post('/masteradmin/updatearticletype', [MasterController::class, 'updatearticletype'])->name('masteradmin.updatearticletype');
    Route::get('/masteradmin/deletearticletype/{id}', [MasterController::class, 'deletearticletype'])->name('masteradmin.deletearticletype');
    Route::get('/masteradmin/statusarticletype/{id}', [MasterController::class, 'statusarticletype'])->name('masteradmin.statusarticletype');

    //Department fields
    Route::get('/masteradmin/department', [MasterController::class, 'department'])->name('masteradmin.department');
    Route::get('/masteradmin/createdepartment', [MasterController::class, 'createdepartment'])->name('masteradmin.createdepartment');
    Route::post('/masteradmin/storedepartment', [MasterController::class, 'storedepartment'])->name('masteradmin.storedepartment');
    Route::get('/masteradmin/editdepartment/{id}', [MasterController::class, 'editdepartment'])->name('masteradmin.editdepartment');
    Route::post('/masteradmin/updatdepartment', [MasterController::class, 'updatdepartment'])->name('masteradmin.updatdepartment');
    Route::get('/masteradmin/deletedepartment/{id}', [MasterController::class, 'deletedepartment'])->name('masteradmin.deletedepartment');

    //Department fields
    Route::get('/masteradmin/departmentfields', [MasterController::class, 'departmentfields'])->name('masteradmin.departmentfields');
    Route::get('/masteradmin/createdepartmentfields', [MasterController::class, 'createdepartmentfields'])->name('masteradmin.createdepartmentfields');
    Route::post('/masteradmin/storedepartmentfields', [MasterController::class, 'storedepartmentfields'])->name('masteradmin.storedepartmentfields');
    Route::get('/masteradmin/editdepartmentfields/{id}', [MasterController::class, 'editdepartmentfields'])->name('masteradmin.editdepartmentfields');
    Route::post('/masteradmin/updatdepartmentfields', [MasterController::class, 'updatdepartmentfields'])->name('masteradmin.updatdepartmentfields');
    Route::get('/masteradmin/deletedepartmentfields/{id}', [MasterController::class, 'deletedepartmentfields'])->name('masteradmin.deletedepartmentfields');

    //Department cat
    Route::get('/masteradmin/departmentcategory', [MasterController::class, 'departmentcat'])->name('masteradmin.departmentcat');
    Route::get('/masteradmin/createdepartmentcat', [MasterController::class, 'createdepartmentcat'])->name('masteradmin.createdepartmentcat');
    Route::post('/masteradmin/storedepartmentcat', [MasterController::class, 'storedepartmentcat'])->name('masteradmin.storedepartmentcat');
    Route::get('/masteradmin/editdepartmentcat/{id}', [MasterController::class, 'editdepartmentcat'])->name('masteradmin.editdepartmentcat');
    Route::post('/masteradmin/updatdepartmentcat', [MasterController::class, 'updatdepartmentcat'])->name('masteradmin.updatdepartmentcat');
    Route::get('/masteradmin/deletedepartmentcat/{id}', [MasterController::class, 'deletedepartmentcat'])->name('masteradmin.deletedepartmentcat');

    //Offices
    Route::get('/masteradmin/offices', [MasterController::class, 'offices'])->name('masteradmin.offices');
    Route::get('/masteradmin/createoffice', [MasterController::class, 'createoffice'])->name('masteradmin.createoffice');
    Route::post('/masteradmin/depacategorysel', [MasterController::class, 'depacategorysel'])->name('masteradmin.depacategorysel');
    Route::post('/masteradmin/storeoffice', [MasterController::class, 'storeoffice'])->name('masteradmin.storeoffice');
    Route::get('/masteradmin/editoffice/{id}', [MasterController::class, 'editoffice'])->name('masteradmin.editoffice');
    Route::post('/masteradmin/updateoffice', [MasterController::class, 'updateoffice'])->name('masteradmin.updateoffice');
    Route::get('/masteradmin/deleteoffice/{id}', [MasterController::class, 'deleteoffice'])->name('masteradmin.deleteoffice');
    Route::get('/masteradmin/Orderchangeofficelist_form', [MasterController::class, 'Orderchangeofficelist_form'])->name('masteradmin.Orderchangeofficelist_form');

    //Menulinktype
    Route::get('/masteradmin/menulinktype', [MasterController::class, 'menulinktype'])->name('masteradmin.menulinktype');
    Route::post('/masteradmin/storemenulinktype', [MasterController::class, 'storemenulinktype'])->name('masteradmin.storemenulinktype');
    Route::get('/masteradmin/editMenulinktype/{id}', [MasterController::class, 'editMenulinktype'])->name('masteradmin.editMenulinktype');
    Route::post('/masteradmin/updateMenulinktype', [MasterController::class, 'updateMenulinktype'])->name('masteradmin.updateMenulinktype');
    Route::get('/masteradmin/deleteMenulinktype/{id}', [MasterController::class, 'deleteMenulinktype'])->name('masteradmin.deleteMenulinktype');
    Route::get('/masteradmin/statusmenutype/{id}', [MasterController::class, 'statusmenutype'])->name('masteradmin.statusmenutype');

    //Announcement Type
    Route::get('/masteradmin/announcementtype', [MasterController::class, 'announcementtype'])->name('masteradmin.announcementtype');
    Route::get('/masteradmin/createannouncementtype', [MasterController::class, 'createannouncementtype'])->name('masteradmin.createannouncementtype');
    Route::post('/masteradmin/storeannouncementtype', [MasterController::class, 'storeannouncementtype'])->name('masteradmin.storeannouncementtype');
    Route::get('/masteradmin/editannouncementtype/{id}', [MasterController::class, 'editannouncementtype'])->name('masteradmin.editannouncementtype');
    Route::post('/masteradmin/updateannouncementtype', [MasterController::class, 'updateannouncementtype'])->name('masteradmin.updateannouncementtype');
    Route::get('/masteradmin/deleteannouncementtype/{id}', [MasterController::class, 'deleteannouncementtype'])->name('masteradmin.deleteannouncementtype');
    Route::get('/masteradmin/statusannouncementtype/{id}', [MasterController::class, 'statusannouncementtype'])->name('masteradmin.statusannouncementtype');

    Route::get('/masteradmin/gallerytype', [MasterController::class, 'gallerytype'])->name('masteradmin.gallerytype');
    Route::post('/masteradmin/storegallerytype', [MasterController::class, 'storegallerytype'])->name('masteradmin.storegallerytype');
    Route::get('/masteradmin/editgaltype/{id}', [MasterController::class, 'editgaltype'])->name('masteradmin.editgaltype');
    Route::post('/masteradmin/updategallerytype', [MasterController::class, 'updategallerytype'])->name('masteradmin.updategallerytype');
    Route::get('/masteradmin/deletegaltype/{id}', [MasterController::class, 'deletegaltype'])->name('masteradmin.deletegaltype');

    Route::get('/masteradmin/gallerycategory', [MasterController::class, 'gallerycategory'])->name('masteradmin.gallerycategory');
    Route::get('/masteradmin/creategallerycategory', [MasterController::class, 'creategallerycategory'])->name('masteradmin.creategallerycategory');
    Route::post('/masteradmin/storegallerycategory', [MasterController::class, 'storegallerycategory'])->name('masteradmin.storegallerycategory');
    Route::get('/masteradmin/editgalcategory/{id}', [MasterController::class, 'editgalcategory'])->name('masteradmin.editgalcategory');
    Route::post('/masteradmin/updategallerycategory', [MasterController::class, 'updategallerycategory'])->name('masteradmin.updategallerycategory');
    Route::get('/masteradmin/deletegalcategory/{id}', [MasterController::class, 'deletegalcategory'])->name('masteradmin.deletegalcategory');

    //WellnessTipType
    Route::get('/masteradmin/WellnessTipType', [MasterController::class, 'WellnessTipType'])->name('masteradmin.WellnessTipType');
    Route::get('/masteradmin/createWellnessTipType', [MasterController::class, 'createWellnessTipType'])->name('masteradmin.createWellnessTipType');
    Route::post('/masteradmin/storeWellnessTipType', [MasterController::class, 'storeWellnessTipType'])->name('masteradmin.storeWellnessTipType');
    Route::get('/masteradmin/editWellnessTipType/{id}', [MasterController::class, 'editWellnessTipType'])->name('masteradmin.editWellnessTipType');
    Route::post('/masteradmin/updateWellnessTipType', [MasterController::class, 'updateWellnessTipType'])->name('masteradmin.updateWellnessTipType');
    Route::get('/masteradmin/deleteWellnessTipType/{id}', [MasterController::class, 'deleteWellnessTipType'])->name('masteradmin.deleteWellnessTipType');

    //Designation
    Route::get('/masteradmin/Designation', [MasterController::class, 'designation'])->name('masteradmin.designation');
    Route::post('/masteradmin/storedesignation', [MasterController::class, 'storedesignation'])->name('masteradmin.storedesignation');
    Route::get('/masteradmin/editdesignation/{id}', [MasterController::class, 'editdesignation'])->name('masteradmin.editdesignation');
    Route::post('/masteradmin/updatedesignation', [MasterController::class, 'updatedesignation'])->name('masteradmin.updatedesignation');
    Route::get('/masteradmin/deletedesignation/{id}', [MasterController::class, 'deletedesignation'])->name('masteradmin.deletedesignation');
    Route::get('/masteradmin/statusdesignation/{id}', [MasterController::class, 'statusdesignation'])->name('masteradmin.statusdesignation');

    //Keytags
    Route::get('/masteradmin/keywordtag', [MasterController::class, 'keywordtag'])->name('masteradmin.keywordtag');
    Route::get('/masteradmin/createkeywordtag', [MasterController::class, 'createkeywordtag'])->name('masteradmin.createkeywordtag');
    Route::post('/masteradmin/storekeywordtag', [MasterController::class, 'storekeywordtag'])->name('masteradmin.storekeywordtag');
    Route::get('/masteradmin/editkeywordtag/{id}', [MasterController::class, 'editkeywordtag'])->name('masteradmin.editkeywordtag');
    Route::post('/masteradmin/updatekeywordtag', [MasterController::class, 'updatekeywordtag'])->name('masteradmin.updatekeywordtag');
    Route::get('/masteradmin/deletekeywordtag/{id}', [MasterController::class, 'deletekeywordtag'])->name('masteradmin.deletekeywordtag');

    //Link Type
    Route::get('/masteradmin/linktype', [MasterController::class, 'linktype'])->name('linktype');
    Route::get('/masteradmin/createlinktype', [MasterController::class, 'createlinktype'])->name('createlinktype');
    Route::post('/masteradmin/storelinktype', [MasterController::class, 'storelinktype'])->name('storelinktype');
    Route::get('/masteradmin/editlinktype/{id}', [MasterController::class, 'editlinktype'])->name('editlinktype');
    Route::post('/masteradmin/updatelinktype', [MasterController::class, 'updatelinktype'])->name('updatelinktype');
    Route::get('/masteradmin/deletelinktype/{id}', [MasterController::class, 'deletelinktype'])->name('deletelinktype');
    Route::get('/masteradmin/statuslinktype/{id}', [MasterController::class, 'statuslinktype'])->name('statuslinktype');

    //Bulk email
    Route::get('/masteradmin/bulkemail', [EmailController::class, 'bulkemail'])->name('masteradmin.bulkemail');
    Route::post('/masteradmin/sendbulkmail', [EmailController::class, 'sendbulkmail'])->name('masteradmin.sendbulkmail');
    Route::get('/masteradmin/reportmailsent', [EmailController::class, 'reportmailsent'])->name('masteradmin.reportmailsent');

    //Department submenu
    Route::get('/master/departmentsubmenu', [MasterController::class, 'departmentsubmenu'])->name('master.departmentsubmenu');
    Route::post('/masteradmin/storedepartmentsubmenu', [MasterController::class, 'storedepartmentsubmenu'])->name('masteradmin.storedepartmentsubmenu');
    Route::get('/masteradmin/editdepartmentsubmenu/{id}', [MasterController::class, 'editdepartmentsubmenu'])->name('masteradmin.editdepartmentsubmenu');
    Route::post('/masteradmin/updatedepartmentsubmenu', [MasterController::class, 'updatedepartmentsubmenu'])->name('masteradmin.updatedepartmentsubmenu');
    Route::get('/masteradmin/deletedepartmentsubmenu/{id}', [MasterController::class, 'deletedepartmentsubmenu'])->name('masteradmin.deletedepartmentsubmenu');
    Route::get('/masteradmin/statusdepartmenusubmenu/{id}', [MasterController::class, 'statusdepartmenusubmenu'])->name('masteradmin.statusdepartmenusubmenu');
    

    

});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\Siteadmin', 'prevent-back-history', 'CORS', 'XSS']], function () {
    //Dashboard
    Route::get('siteadminhome', [SiteadminController::class, 'siteadminhome'])->name('siteadminhome');

    //article
    Route::get('/siteadmin/articlelist', [SiteadminController::class, 'articlelist'])->name('articlelist');
    Route::get('/siteadmin/createarticle', [SiteadminController::class, 'createarticle'])->name('createarticle');
    Route::post('/siteadmin/storearticle', [SiteadminController::class, 'storearticle'])->name('storearticle');
    Route::get('/siteadmin/editarticle/{id}', [SiteadminController::class, 'editarticle'])->name('editarticle');
    Route::post('/siteadmin/updatearticle', [SiteadminController::class, 'updatearticle'])->name('updatearticle');
    Route::get('/siteadmin/deletearticle/{id}', [SiteadminController::class, 'deletearticle'])->name('deletearticle');
    Route::post('/siteadmin/article_check_title_unique', [SiteadminController::class, 'article_check_title_unique'])->name('siteadmin.article_check_title_unique');
    Route::get('/siteadmin/articleidencrypt', [SiteadminController::class, 'articleidencrypt'])->name('siteadmin.articleidencrypt');
    Route::get('/siteadmin/statusarticle/{id}', [SiteadminController::class, 'statusarticle'])->name('siteadmin.statusarticle');
    Route::get('/siteadmin/getofficedetails', [SiteadminController::class, 'getofficedetails'])->name('siteadmin.getofficedetails');
    Route::get('/siteadmin/depsubmenus', [SiteadminController::class, 'depsubmenus'])->name('siteadmin.depsubmenus');
    Route::get('/siteadmin/getsubmenus', [SiteadminController::class, 'getsubmenus'])->name('siteadmin.getsubmenus');
    Route::post('/siteadmin/updateSubmenus', [SiteadminController::class, 'updateSubmenus'])->name('siteadmin.updateSubmenus');

    //Banner
    Route::get('/siteadmin/banner', [SiteadminController::class, 'banner'])->name('banner');
    Route::get('/siteadmin/createbanner', [SiteadminController::class, 'createbanner'])->name('createbanner');
    Route::post('/siteadmin/storebanner', [SiteadminController::class, 'storebanner'])->name('storebanner');
    Route::get('/siteadmin/editbanner/{id}', [SiteadminController::class, 'editbanner'])->name('editbanner');
    Route::post('/siteadmin/updatebanner', [SiteadminController::class, 'updatebanner'])->name('updatebanner');
    Route::get('/siteadmin/deleteBanner/{id}', [SiteadminController::class, 'deleteBanner'])->name('deleteBanner');
    Route::get('/siteadmin/statusbanner/{id}', [SiteadminController::class, 'statusbanner'])->name('statusbanner');

    //Mainmenu
    Route::get('/siteadmin/mainmenu', [SiteadminController::class, 'mainmenu'])->name('mainmenu');
    Route::get('/siteadmin/createmainmenu', [SiteadminController::class, 'createmainmenu'])->name('createmainmenu');
    Route::post('/siteadmin/storeMainmenu', [SiteadminController::class, 'storeMainmenu'])->name('storeMainmenu');
    Route::get('/siteadmin/editmainmenu/{id}', [SiteadminController::class, 'editmainmenu'])->name('editmainmenu');
    Route::post('/siteadmin/updateMainmenu', [SiteadminController::class, 'updateMainmenu'])->name('updateMainmenu');
    Route::get('/siteadmin/deletemainmenu/{id}', [SiteadminController::class, 'deletemainmenu'])->name('deletemainmenu');
    Route::get('/siteadmin/statusmainmenu/{id}', [SiteadminController::class, 'statusmainmenu'])->name('statusmainmenu');
    Route::get('/siteadmin/createmainmenu', [SiteadminController::class, 'createmainmenu'])->name('createmainmenu');
    Route::get('/siteadmin/admin/articleload', [SiteadminController::class, 'articleload'])->name('admin.articleload');
    Route::get('/siteadmin/admin/downloadtypeload', [SiteadminController::class, 'downloadtypeload'])->name('admin.downloadtypeload');
    Route::get('/siteadmin/OrderchangeMainmenu_form', [SiteadminController::class, 'OrderchangeMainmenu_form'])->name('OrderchangeMainmenu_form');
    Route::get('/siteadmin/ordernumbercheckmainmenu', [SiteadminController::class, 'ordernumbercheckmainmenu'])->name('siteadmin.ordernumbercheckmainmenu');

    //Submenu
    Route::get('/siteadmin/submenu', [SiteadminController::class, 'submenu'])->name('submenu');
    Route::get('/siteadmin/createsubmenu', [SiteadminController::class, 'createsubmenu'])->name('createsubmenu');
    Route::post('/siteadmin/storesubmenu', [SiteadminController::class, 'storesubmenu'])->name('storesubmenu');
    Route::get('/siteadmin/editsubmenu/{id}', [SiteadminController::class, 'editsubmenu'])->name('editsubmenu');
    Route::post('/siteadmin/updatesubmenu', [SiteadminController::class, 'updatesubmenu'])->name('updatesubmenu');
    Route::get('/siteadmin/deletesubmenu/{id}', [SiteadminController::class, 'deletesubmenu'])->name('deletesubmenu');
    Route::get('/siteadmin/statussubmenu/{id}', [SiteadminController::class, 'statussubmenu'])->name('statussubmenu');
    Route::get('/siteadmin/sbuwisemainmenu', [SiteadminController::class, 'sbuwisemainmenu'])->name('admin.sbuwisemainmenu');
    Route::get('/siteadmin/OrderchangeSubmenu_form', [SiteadminController::class, 'OrderchangeSubmenu_form'])->name('siteadmin.OrderchangeSubmenu_form');
    Route::get('/siteadmin/ordernumberchecksubmenu', [SiteadminController::class, 'ordernumberchecksubmenu'])->name('siteadmin.ordernumberchecksubmenu');

    //Contact us
    Route::get('/siteadmin/contactus', [SiteadminController::class, 'contactus'])->name('siteadmin.contactus');
    Route::get('/siteadmin/createcontactus', [SiteadminController::class, 'createcontactus'])->name('siteadmin.createcontactus');
    Route::post('/siteadmin/storecontactus', [SiteadminController::class, 'storecontactus'])->name('siteadmin.storecontactus');
    Route::get('/siteadmin/editcontactus/{id}', [SiteadminController::class, 'editcontactus'])->name('siteadmin.editcontactus');
    Route::post('/siteadmin/updatecontactus', [SiteadminController::class, 'updatecontactus'])->name('siteadmin.updatecontactus');
    Route::get('/siteadmin/deletecontactus/{id}', [SiteadminController::class, 'deletecontactus'])->name('siteadmin.deletecontactus');

    //Gallery
    Route::get('/siteadmin/gallerylist', [SiteadminController::class, 'gallery'])->name('siteadmin.gallerylist');
    Route::get('/siteadmin/creategallery', [SiteadminController::class, 'creategallery'])->name('siteadmin.creategallery');
    Route::post('/siteadmin/storegallery', [SiteadminController::class, 'storegallery'])->name('siteadmin.storegallery');
    Route::post('/galitemstore/{id}', [SiteadminController::class, 'galitemstore'])->name('galitemstore');
    Route::get('/siteadmin/editgallery/{id}', [SiteadminController::class, 'editgallery'])->name('siteadmin.editgallery');
    Route::post('/siteadmin/updategallery', [SiteadminController::class, 'updategallery'])->name('siteadmin.updategallery');
    Route::get('/siteadmin/deletegallery/{id}', [SiteadminController::class, 'deletegallery'])->name('siteadmin.deletegallery');
    Route::post('/siteadmin/galitemstoreuppy/{id}', [SiteadminController::class, 'galitemstoreuppy'])->name('siteadmin.galitemstoreuppy');
    Route::get('/viewgallarypics/{id}', [SiteadminController::class, 'viewgallarypics'])
        ->name('viewgallarypics')
        ->middleware('auth');
    Route::get('/siteadmin/galitemdel/{id}', [SiteadminController::class, 'galitemdel'])->middleware('auth');
    Route::get('/siteadmin/statusgallery/{id}', [SiteadminController::class, 'statusgallery'])->name('siteadmin.statusgallery');

    //Links
    Route::get('/siteadmin/links', [SiteadminController::class, 'links'])->name('links');
    Route::get('/siteadmin/createlinks', [SiteadminController::class, 'createlinks'])->name('createlinks');
    Route::post('/siteadmin/storelink', [SiteadminController::class, 'storelink'])->name('storelink');
    Route::get('/siteadmin/editlinks/{id}', [SiteadminController::class, 'editlinks'])->name('editlinks');
    Route::post('/siteadmin/updatelink', [SiteadminController::class, 'updatelink'])->name('updatelink');
    Route::get('/siteadmin/deletelink/{id}', [SiteadminController::class, 'deletelink'])->name('deletelink');
    Route::get('/siteadmin/statuslink/{id}', [SiteadminController::class, 'statuslink'])->name('statuslink');
    Route::get('/siteadmin/Orderchangelinklist_form', [SiteadminController::class, 'Orderchangelinklist_form'])->name('Orderchangelinklist_form');

    // BOD
    Route::get('/siteadmin/BODlist', [SiteadminController::class, 'BODlist'])->name('siteadmin.BODlist');
    Route::get('/siteadmin/CreateBOD', [SiteadminController::class, 'CreateBOD'])->name('siteadmin.CreateBOD');
    Route::post('/siteadmin/storeBOD', [SiteadminController::class, 'storeBOD'])->name('siteadmin.storeBOD');
    Route::get('/siteadmin/editBOD/{id}', [SiteadminController::class, 'editBOD'])->name('siteadmin.editBOD');
    Route::post('/siteadmin/updateBOD', [SiteadminController::class, 'updateBOD'])->name('siteadmin.updateBOD');
    Route::get('/siteadmin/deleteBOD/{id}', [SiteadminController::class, 'deleteBOD'])->name('siteadmin.deleteBOD');

    //Announcements
    Route::get('/siteadmin/announcements', [SiteadminController::class, 'announcements'])->name('siteadmin.announcements');
    Route::get('/siteadmin/createannouncements', [SiteadminController::class, 'createannouncements'])->name('siteadmin.createannouncements');
    Route::post('/siteadmin/storeannouncement', [SiteadminController::class, 'storeannouncement'])->name('siteadmin.storeannouncement');
    Route::get('/siteadmin/editannouncement/{id}', [SiteadminController::class, 'editannouncement'])->name('siteadmin.editannouncement');
    Route::post('/siteadmin/updateannouncement', [SiteadminController::class, 'updateannouncement'])->name('siteadmin.updateannouncement');
    Route::get('/siteadmin/deleteannouncement/{id}', [SiteadminController::class, 'deleteannouncement'])->name('siteadmin.deleteannouncement');
    Route::get('/siteadmin/statusannouncement/{id}', [SiteadminController::class, 'statusannouncement'])->name('siteadmin.statusannouncement');

    //Wellness Tips
    Route::get('/siteadmin/WellnessTips', [SiteadminController::class, 'WellnessTips'])->name('siteadmin.WellnessTips');
    Route::get('/siteadmin/createWellnessTips', [SiteadminController::class, 'createWellnessTips'])->name('siteadmin.createWellnessTips');
    Route::post('/siteadmin/storeWellnessTips', [SiteadminController::class, 'storeWellnessTips'])->name('siteadmin.storeWellnessTips');
    Route::get('/siteadmin/editcreateWellnessTips/{id}', [SiteadminController::class, 'editcreateWellnessTips'])->name('siteadmin.editcreateWellnessTips');
    Route::post('/siteadmin/updatecreateWellnessTips', [SiteadminController::class, 'updatecreateWellnessTips'])->name('siteadmin.updatecreateWellnessTips');
    Route::get('/siteadmin/deletecreateWellnessTips/{id}', [SiteadminController::class, 'deletecreateWellnessTips'])->name('siteadmin.deletecreateWellnessTips');
    Route::get('/siteadmin/statusWellnessTips/{id}', [SiteadminController::class, 'statusWellnessTips'])->name('siteadmin.statusWellnessTips');

    //Award
    Route::get('/siteadmin/Awardlist', [SiteadminController::class, 'Awardlist'])->name('siteadmin.Awardlist');
    Route::get('/siteadmin/createaward', [SiteadminController::class, 'createaward'])->name('siteadmin.createaward');
    Route::post('/siteadmin/storeAward', [SiteadminController::class, 'storeAward'])->name('siteadmin.storeAward');
    Route::get('/siteadmin/editAward/{id}', [SiteadminController::class, 'editAward'])->name('siteadmin.editAward');
    Route::post('/siteadmin/updateAward', [SiteadminController::class, 'updateAward'])->name('siteadmin.updateAward');
    Route::get('/siteadmin/deleteAward/{id}', [SiteadminController::class, 'deleteAward'])->name('siteadmin.deleteAward');
    Route::get('/siteadmin/statusAward/{id}', [SiteadminController::class, 'statusAward'])->name('siteadmin.statusAward');

    Route::post('/siteadmin/awarditemstoreuppy/{id}', [SiteadminController::class, 'awarditemstoreuppy'])->name('siteadmin.awarditemstoreuppy');
    Route::get('/siteadmin/viewawarditem/{id}', [SiteadminController::class, 'viewawarditem'])->name('siteadmin.viewawarditem')->middleware('auth');
    Route::get('/siteadmin/deleteAwarditem/{id}', [SiteadminController::class, 'deleteAwarditem'])->middleware('auth');

    //Hero of the month
    Route::get('/siteadmin/HerooftheMonth', [SiteadminController::class, 'HerooftheMonth'])->name('siteadmin.HerooftheMonth');
    Route::get('/siteadmin/createHeroOfMonth', [SiteadminController::class, 'createHeroOfMonth'])->name('siteadmin.createHeroOfMonth');
    Route::post('/siteadmin/storeHeroOfMonth', [SiteadminController::class, 'storeHeroOfMonth'])->name('siteadmin.storeHeroOfMonth');
    Route::get('/siteadmin/editHeroOfMonth/{id}', [SiteadminController::class, 'editHeroOfMonth'])->name('siteadmin.editHeroOfMonth');
    Route::post('/siteadmin/updateHeroOfMonth', [SiteadminController::class, 'updateHeroOfMonth'])->name('siteadmin.updateHeroOfMonth');
    Route::get('/siteadmin/deleteHeroOfMonth/{id}', [SiteadminController::class, 'deleteHeroOfMonth'])->name('siteadmin.deleteHeroOfMonth');
    Route::get('/siteadmin/statusHeroOfMonth/{id}', [SiteadminController::class, 'statusHeroOfMonth'])->name('siteadmin.statusHeroOfMonth');

    //Sitecontrollabel
    Route::get('/siteadmin/sitecontrollabellist', [SiteadminController::class, 'sitecontrollabellist'])->name('siteadmin.sitecontrollabellist');
    Route::get('/siteadmin/createsitecontrollabel', [SiteadminController::class, 'createsitecontrollabel'])->name('siteadmin.createsitecontrollabel');
    Route::post('/siteadmin/storesitecontrollabel', [SiteadminController::class, 'storesitecontrollabel'])->name('siteadmin.storesitecontrollabel');
    Route::get('/siteadmin/editsitecontrollabel/{id}', [SiteadminController::class, 'editsitecontrollabel'])->name('siteadmin.editsitecontrollabel');
    Route::post('/siteadmin/updatesitecontrollabel', [SiteadminController::class, 'updatesitecontrollabel'])->name('siteadmin.updatesitecontrollabel');
    Route::get('/siteadmin/deletesitecontrollabel/{id}', [SiteadminController::class, 'deletesitecontrollabel'])->name('siteadmin.deletesitecontrollabel');
    Route::get('/siteadmin/keyidchecksitecontrollabel', [SiteadminController::class, 'keyidchecksitecontrollabel'])->name('siteadmin.keyidchecksitecontrollabel');
    Route::get('/siteadmin/statussitecontrollabel/{id}', [SiteadminController::class, 'statussitecontrollabel'])->name('siteadmin.statussitecontrollabel');

    //officedetails
    Route::get('siteadmin/officedetails', [SiteadminController::class, 'officedetails'])->name('siteadmin.officedetails');
    Route::get('/siteadmin/createofficedetail', [SiteadminController::class, 'createofficedetail'])->name('siteadmin.createofficedetaill');
    Route::post('/siteadmin/storeofficedetails', [SiteadminController::class, 'storeofficedetails'])->name('siteadmin.storeofficedetails');
    Route::get('/siteadmin/editofficedetails/{id}', [SiteadminController::class, 'editofficedetails'])->name('siteadmin.editofficedetails');
    Route::post('/siteadmin/updateofficedetails', [SiteadminController::class, 'updateofficedetails'])->name('siteadmin.updateofficedetails');
    Route::get('/siteadmin/statusofficedetails/{id}', [SiteadminController::class, 'statusofficedetails'])->name('siteadmin.statusofficedetails');
    Route::get('/siteadmin/deleteofficedetails/{id}', [SiteadminController::class, 'deleteofficedetails'])->name('siteadmin.deleteofficedetails');

    //Survey
    Route::get('siteadmin/solutionexchange', [SiteadminController::class, 'solutionexchange'])->name('siteadmin.solutionexchange');
    Route::get('/siteadmin/createsurvey', [SiteadminController::class, 'createsurvey'])->name('siteadmin.createsurvey');
    Route::post('/siteadmin/surveystore', [SiteadminController::class, 'surveystore'])->name('siteadmin.surveystore');
    Route::post('/siteadmin/surveyupdate', [SiteadminController::class, 'surveyupdate'])->name('siteadmin.surveyupdate');

    //Survey 2
   Route::get('/siteadmin/surveynew', [SiteadminController::class, 'polllist'])->name('siteadmin.polllist');
   Route::get('/siteadmin/createpoll', [SiteadminController::class, 'createpoll'])->name('siteadmin.createpoll');
   Route::post('/siteadmin/storepoll', [SiteadminController::class, 'storepoll'])->name('siteadmin.storepoll');
   Route::get('/siteadmin/deletepoll/{id}', [SiteadminController::class, 'deletepoll'])->name('siteadmin.deletepoll');
   Route::get('/siteadmin/pollresult/{id}', [SiteadminController::class, 'pollresult'])->name('siteadmin.pollresult');
   Route::get('/siteadmin/statuspoll/{id}', [SiteadminController::class, 'statuspoll'])->name('siteadmin.statuspoll');

   //institution
   Route::get('/institution', [SiteadminController::class, 'institution'])->name('siteadmin.institution');
   Route::post('/import', [SiteadminController::class, 'import'])->name('import.users');  
   Route::get('/kaleidoscope', [SiteadminController::class, 'kaleidoscope'])->name('kaleidoscope');  
   Route::post('/kaleidoscope-children', [SiteadminController::class, 'getKaleidoscopeChildren'])->name('kaleidoscope.children');
});


Route::group(['middleware' => ['auth', 'App\Http\Middleware\ACSadmin', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('acsadminhome', [AcsController::class, 'acsadminhome'])->name('acsadminhome');

    //Hero of the month
    Route::get('/acs/HerooftheMonthApprove', [AcsController::class, 'HerooftheMonthApprove'])->name('acs.HerooftheMonthApprove');
    Route::post('/acs/storeHeroOfMonthRemark', [AcsController::class, 'storeHeroOfMonthRemark'])->name('acs.storeHeroOfMonthRemark');
    Route::get('/acs/heromonthdetails/{id}', [AcsController::class, 'heromonthdetails'])->name('acs.heromonthdetails');

    //Suggestion report
    Route::get('/acs/suggestionreport', [AcsController::class, 'suggestionreport'])->name('acs.suggestionreport');
    Route::get('/acs/reportpdf', [AcsController::class, 'reportpdf'])->name('acs.reportpdf');
    Route::get('/acs/suggestiondetails/{id}', [AcsController::class, 'suggestiondetails'])->name('acs.suggestiondetails');
    Route::get('/acs/exportPdf/{id}', [AcsController::class, 'exportPdf'])->name('acs.exportPdf');
    Route::post('/acs/suggestionapproverRemark', [AcsController::class, 'suggestionapproverRemark'])->name('acs.suggestionapproverRemark');
    Route::post('/acs/officewisesearch', [AcsController::class, 'officewisesearch'])->name('acs.officewisesearch');

});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\Officerlogin', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('officerhome', [OfficerController::class, 'officerhome'])->name('officerhome');

    //Officers suggestions 
    Route::get('/officer/suggestion', [OfficerController::class, 'suggestion'])->name('officer.suggestion');
    Route::get('/officer/createsuggestion', [OfficerController::class, 'createsuggestion'])->name('officer.createsuggestion');
    Route::post('/officer/storesuggestion', [OfficerController::class, 'storesuggestion'])->name('officer.storesuggestion');
    Route::get('/officer/statussuggestion/{id}', [OfficerController::class, 'statussuggestion'])->name('officer.statussuggestion');
    Route::get('/officer/editsuggestion/{id}', [OfficerController::class, 'editsuggestion'])->name('officer.editsuggestion');
    Route::get('/officer/deletesuggestion/{id}', [OfficerController::class, 'deletesuggestion'])->name('officer.deletesuggestion');
    Route::post('/officer/updatesuggestion', [OfficerController::class, 'updatesuggestion'])->name('officer.updatesuggestion');

    Route::post('/officer/suggattachmtupload/{id}', [OfficerController::class, 'suggattachmtupload'])->name('officer.suggattachmtupload');
    Route::get('/officer/deletesuggestionupload/{id}', [OfficerController::class, 'deletesuggestionupload'])->name('officer.deletesuggestionupload');
    Route::get('/officer/viewsuggestionitem/{id}', [OfficerController::class, 'viewsuggestionitem'])->name('officer.viewsuggestionitem');

    Route::get('/officers/passwordchange', [OfficerController::class, 'passwordchange'])->name('officers.passwordchange');
    Route::post('/officer/passwordupdate', [OfficerController::class, 'passwordupdate'])->name('officer.passwordupdate');

    Route::get('/officers/usermanual', [OfficerController::class, 'usermanual'])->name('officers.usermanual');

    



});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\EditorMiddleware', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('editorhome', [EditorController::class, 'editorhome'])->name('editorhome');

    Route::get('/editor/suggestionreport', [AcsController::class, 'suggestionreport'])->name('editor.suggestionreport');
    Route::get('/editor/reportpdf', [AcsController::class, 'reportpdf'])->name('editor.reportpdf');
    Route::get('/editor/suggestiondetails/{id}', [AcsController::class, 'suggestiondetails'])->name('editor.suggestiondetails');
    Route::get('/editor/exportPdf/{id}', [AcsController::class, 'exportPdf'])->name('editor.exportPdf');
    Route::post('/editor/officewisesearch', [AcsController::class, 'officewisesearch'])->name('editor.officewisesearch');
    
    Route::get('/editor/suggestionreport', [AcsController::class, 'suggestionreport'])->name('editor.suggestionreport');

    //user
    Route::get('/editor/userdetails', [AdminController::class, 'user'])->name('editor.user');

   //Gallery module
   Route::get('/editor/gallerymodule', [EditorController::class, 'gallerymodule'])->name('editor.gallerymodule');
   Route::get('/editor/docdetails/{id}/{type}', [EditorController::class, 'docdetails'])->name('editor.docdetails');
   Route::get('/editor/itemdetails/{id}/{type}', [EditorController::class, 'itemdetails'])->name('editor.itemdetails');
   Route::post('/editor/suggestionapproverRemark', [AcsController::class, 'suggestionapproverRemark'])->name('editor.suggestionapproverRemark');
   Route::get('/editor/suggestionreport', [AcsController::class, 'suggestionreport'])->name('editor.suggestionreport');
});

Route::group(['middleware' => ['auth', 'App\Http\Middleware\Dashboarduserlogin', 'prevent-back-history', 'CORS', 'XSS']], function () {

    Route::get('dashboarduser', [DashboardAdminController::class, 'dashboarduser'])->name('dashboarduser');
});