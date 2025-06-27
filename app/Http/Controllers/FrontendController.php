<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Award;
use App\Models\Banner;
use App\Models\BOD;
use App\Models\Contactus;
use App\Models\DepartmentCat;
use App\Models\Department;
use App\Models\HerooftheMonth;
use App\Models\Language;
use App\Models\Link;
use App\Models\Mainmenu;
use App\Models\Office;
use App\Models\Sitecontrollabel;
use App\Models\wellnessTip;
use App\Models\Keywordtagsub;
use App\Models\Gallery;
use App\Models\Articletype;
use App\Models\wellnessTipType;
use App\Models\User;
use App\Models\DepartmentSubmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Request;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Support\Facades\Crypt;
use Session;

class FrontendController extends Controller
{
    //
    public function index($langid = null)
    {
        try {
            // dd(Session::get('bilingual'));

            if (! Session::has('bilingual')) {
                Session::put('bilingual', 1);
            }
            $sessionbil = Session::get('bilingual');
// dd($sessionbil);
            $language = Language::where('delet_flag', 0)->orderBy('name')->get();

            $mainsubmenu = $this->mainmenu($sessionbil);
            $whatsnews = $this->whatsmaquee($sessionbil);
            $mainbanners = $this->mainbanner($sessionbil);
            $bods = $this->bod($sessionbil);
            $mainannouncements = $this->mainannouncement($sessionbil);
            $mainawards = $this->mainaward($sessionbil);
            $mainEmergInfos = $this->mainEmergInfo($sessionbil);
            $maindepartments = $this->maindepartment($sessionbil);
            $mainprojects = $this->mainprojects($sessionbil);
            $mainarticles = $this->mainarticle($sessionbil);
            $SolutionExchanges = $this->SolutionExchange($sessionbil);
            $HerooftheMonth = $this->HerooftheMonth($sessionbil);
            $wellnessTips = $this->mainwellnesstip($sessionbil);
            $healthAlerts = $this->healthAlerts($sessionbil);
            $healthAlertSitecntl = $this->healthAlertSitecntl($sessionbil);
            $Usefullinks = $this->Usefullinks($sessionbil);
            $Importantlinks = $this->Importantlinks($sessionbil);
            $mainfootercontactus = $this->mainfootercontactus($sessionbil);
            $mainorganizations = $this->mainorganizations($sessionbil);
            $officelists = $this->officelist($sessionbil);
            $orgnazationlists =$this->orgnazationlist($sessionbil);
            $sitecontrollabels      = $this->siteControlLables($sessionbil);
            $mainhealthscapes      = $this->mainhealthscape($sessionbil);
            $sustainables          = $this->Sustainable($sessionbil);
            

            return view('frontend.main.mainhomepage', compact(
                'sessionbil',
                'language',
                'mainsubmenu',
                'whatsnews',
                'mainbanners',
                'bods',
                'mainannouncements',
                'mainawards',
                'mainEmergInfos',
                'maindepartments',
                'mainprojects',
                'mainarticles',
                'SolutionExchanges',
                'HerooftheMonth',
                'wellnessTips',
                'healthAlerts',
                'healthAlertSitecntl',
                'Usefullinks',
                'mainfootercontactus',
                'Importantlinks',
                'mainorganizations',
                'officelists',
                'orgnazationlists',
                'sitecontrollabels',
                'mainhealthscapes',
                'sustainables'
            ));
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);
        }
    }

    public function announcement()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $sitecontrolls = Sitecontrollabel::with(['sitelcontrollabel_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('id', 48)->where('status_id', 1)->first();

        $announcements = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 2)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.main.announcement', compact('mainsubmenu','sitecontrolls','sessionbil','announcements'));
    }

    public function department_list()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('office_view_flag',1)->whereIn('depcat', [1,2])->orderBy('orderno')
        ->orderBy('orderno')->get();

        return view('frontend.main.department-list', compact('mainsubmenu','sessionbil','officelists'));
    }

    public function orgnazationlistdetail()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('office_view_flag',1)->whereIn('depcat', [3,4])->orderBy('orderno')->where('status_id', 1)->get();
// dd($officelists);
        // $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
        //     $query->where('languageid', $sessionbil);
        // }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
        //     $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
        //         $q2->where('languageid', $sessionbil);
        //     }]);
        // }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
        //     $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
        //         $q4->where('languageid', $sessionbil);
        //     }]);
        // }])->whereIn('depcat', [3,4])->where('office_view_flag',1)->get();

        return view('frontend.main.orgnazation-list', compact('mainsubmenu','sessionbil','officelists'));
    }

    public function dobmessage_detail($id)
    {
        $id = Crypt::decryptString($id);
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $boddetails = BOD::with([
            'bodsub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])->with(['designation' => function ($q1) {
            $q1->with(['des_sub' => function ($q2) {
                $q2->where('languageid', 1);
            }]);
        }])
            ->where('status', 1)
            // ->orderBy('id', 'DESC')
            ->where('chief_officers_flag', $sessionbil)
            ->where('id', $id)
            ->first();

        $allboddetails = BOD::with([
            'bodsub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])->with(['designation' => function ($q1) {
            $q1->with(['des_sub' => function ($q2) {
                $q2->where('languageid', 1);
            }]);
        }])
            ->where('status', 1)
            ->whereNotIn('id', [$id])
            // ->orderBy('id', 'DESC')
            ->where('chief_officers_flag', $sessionbil)
            ->get();

        // dd($boddetails);
        return view('frontend.main.message-detail', compact('mainsubmenu', 'boddetails', 'allboddetails','sessionbil'));
    }

    public function announcementitem($id)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $announcementitem = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 2)
            ->where('status_id', 1)
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        return view('frontend.main.announcementitem', compact('mainsubmenu', 'announcementitem','sessionbil'));
    }

    public function department_details($title,$id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $id = Crypt::decryptString($id);
    
        $departments = Department::with(['dep_sub' => function ($q1) use ($sessionbil) {
            $q1->where('languageid', $sessionbil);
        }])->where('id',$id)->first();

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                                $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                                    $q2->where('languageid', $sessionbil);
                                }]);
                            }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                                $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                                    $q4->where('languageid', $sessionbil);
                                }]);
                            }])->with(['officedetail' => function($q5) use($sessionbil){
                                $q5->with(['officedetailsub' => function ($q6) use ($sessionbil) {
                                    $q6->where('languageid', $sessionbil);
                                }]);
                            }])->where('id', $id)->first();

        // $ArticleDepartment = ArticleDepartment::where('articleid',$id)->get();

        $ArticleDepartments = Article::where('status_id', 1)
                            ->with('articleval_sub', function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            })
                            ->whereHas('articledep', function ($q1) use ($id) {
                                $q1->where('officeId', $id);
                            })
                            ->with(['articledep']) // No need to filter again in with()
                            ->orderBy('id', 'ASC')
                            ->get();
        // dd($ArticleDepartments);
        $R_ArticleDepartments = Article::where('status_id', 1)
                            ->with('articleval_sub', function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            })
                            ->whereHas('articledep', function ($q1) use ($id) {
                                $q1->where('officeId', $id);
                            })
                            ->with(['articledep']) // No need to filter again in with()
                            ->orderBy('id', 'DESC')
                            ->whereNotIn('articletype_id', [25, 24, 23, 22, 21, 19])
                            ->get();                    

                $submenu = $officelists->submenus;
               
                $submenuIds = array_map('intval', explode(',', $submenu));
                $submenus = [];

                foreach ($submenuIds as $id) {
                    $submenu = DepartmentSubmenu::with(['dep_submenu' => function ($query) {
                        $query->where('languageid', 1); // or dynamic language ID
                    }])->find($id);

                    if ($submenu) {
                        $submenus[] = $submenu;
                    }
                }
        //   @dd($submenus);
        // ✅ Move articletype_id == 19 to the end
            usort($submenus, function ($a, $b) {
                return ($a->id == 15) <=> ($b->id == 15);
            });
        // $weburl = $officelists->officedetail[0]->websiteurl;
        if (!empty($officelists) && isset($officelists->officedetail[0]) && !empty($officelists->officedetail[0]->websiteurl)) {
            $weburl = $officelists->officedetail[0]->websiteurl;
        } else {
            $weburl = '';
        }
        // dd($ArticleDepartments);
        return view('frontend.main.department-details', compact('mainsubmenu', 'R_ArticleDepartments','departments','sessionbil','officelists','weburl','ArticleDepartments','submenus'));
    }

    public function sdg()
    {
        return view('frontend.main.sdg');
    }

    public function news_detail()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }

        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        return view('frontend.main.news-detail', compact('mainsubmenu','sessionbil'));
    }

    //////////////////////////////Private functions////////////////////////////////////////////////
    private function mainmenu($sessionbil)
    {
        $mainsubmenu = Mainmenu::with(['sub_menu' => function ($query) use ($sessionbil) {
            $query->with(['submenusub' => function ($query1) use ($sessionbil) {
                $query1->where('languageid', $sessionbil);
            }]);

            $query->with(['subsubmenu' => function ($query3) use ($sessionbil) {
                $query3->with(['subsubmenusub' => function ($query4) use ($sessionbil) {
                    $query4->where('languageid', $sessionbil);
                }]);
                $query3->orderBy('orderno', 'asc');
            }]);
            $query->where('status_id', 1);
            $query->orderBy('orderno', 'asc');
        }])

            ->with(['mainmenu_sub' => function ($query2) use ($sessionbil) {
                $query2->where('languageid', $sessionbil);
            }])
            ->where('status_id', 1)
            ->orderBy('orderno', 'asc')
            ->get();

        return $mainsubmenu;
    }

    public function whatsmaquee()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $whatsnew = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 1)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return $whatsnew;
    }

    public function whats()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);

        return view('frontend.main.whats', compact('mainsubmenu','sessionbil'));
    }

    public function whatsnew($id)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $whatsnewitems = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 1)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->where('id', $id)
            ->first();

        $whatsnewallitems = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 1)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        $mainsubmenu = $this->mainmenu($sessionbil);

        return view('frontend.main.whats-news-detail', compact('mainsubmenu', 'whatsnewitems', 'whatsnewallitems','sessionbil'));
    }

    public function mainbanner($sessionbil)
    {
        $mainbanner = Banner::with([
            'banner_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('delet_flag', 0)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->latest()
            ->get();

        return $mainbanner;
    }

    public function mainhealthscape($sessionbil)
    {
 
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $healthscape = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',12)->first();

        return $healthscape;
    }

    public function bod($sessionbil)
    {
        $bod = BOD::with([
            'bodsub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])->with(['designation' => function ($q1) {
            $q1->with(['des_sub' => function ($q2) {
                $q2->where('languageid', 1);
            }]);
        }])
            ->where('status', 1)
            // ->orderBy('id', 'DESC')
            ->where('chief_officers_flag', $sessionbil)
            ->limit(3)
            ->get();

        return $bod;
    }

    public function mainannouncement()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $announcement = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 2)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return $announcement;
    }

    public function mainaward()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $awards = Award::with([
            'awardsub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return $awards;
    }

    public function mainEmergInfo()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $emergInfos = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 3)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return $emergInfos;
    }

    public function Sustainable()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

            $sustainables = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->where('status_id', 1)->where('articletype_id',16)->orderBy('id', 'DESC')->limit(5)->get();

        return $sustainables;
    }

    public function maindepartment()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $DepartmentCat = DepartmentCat::with(['depcat_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->where('departmentfieldid', 1)->get();

        return $DepartmentCat;
    }

    public function mainorganizations()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $DepartmentCat2 = DepartmentCat::with(['depcat_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->where('departmentfieldid', 2)->get();

        return $DepartmentCat2;
    }

    public function mainprojects()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $sitecontrolls = Sitecontrollabel::with(['sitelcontrollabel_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('id', 45)->where('status_id', 1)->first();

        return $sitecontrolls;
    }

    public function mainarticle()
    {
       
        if (!Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        
        $articles=  Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
            //   ->whereNotNull('file');
        }])->with(['articletypeval'=> function($q1) use ($sessionbil){
            $q1->with(['articletype_sub' => function ($q2) use($sessionbil){
                $q2->where('languageid', $sessionbil);
            }]);
        }])
        ->whereIn('articletype_id', [8, 9, 10, 11])
        ->where('status_id', 1)
        ->orderBy('id', 'DESC')
        ->where('front_view_flag',1)
        ->get()
        ->groupBy('articletype_id')
        ->map(function ($group) {
            return $group->first();
        })->values();

        
        foreach ($articles as $article) {
            $tags_ids = $article->articleval_sub[0]->tags_id ?? null; // Handle null case
        
            if (!empty($tags_ids)) {
                $values = explode(',', $tags_ids);
        
                // Fetch all related Keywordtagsub records in one query
                $keydatas = Keywordtagsub::where('languageid', $sessionbil)
                            ->whereIn('keywordtagid', $values)
                            ->get();
            } else {
                $keydatas = collect(); // Return an empty collection if no tags
            }
            // Attach keydatas to the article object
            $article->keydatas = $keydatas;
        }
        // dd($articles);
        // Return the modified articles collection with keydatas included
        return $articles;
        
    }

    public function SolutionExchange()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $SolutionExchange = Sitecontrollabel::with(['sitelcontrollabel_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('id', 46)->where('status_id', 1)->first();

        return $SolutionExchange;
    }

    public function HerooftheMonth()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $HerooftheMonth = HerooftheMonth::with(['heromonthsub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->latest()->where('status_id', 1)->first();

        return $HerooftheMonth;
    }

    public function mainwellnesstip()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        // $wellnessTips = wellnessTip::with(['wellnessTipsub' => function ($query) use ($sessionbil) {
        //     // $query->select('alternatetext','subtitle','title')->where('delet_flag',0);
        //     $query->where('languageid', $sessionbil);
        // }])->with(['wellnessTipType' => function ($q1) use ($sessionbil) {
        //     $q1->with(['wellnessTipTypesub' => function ($q2) use ($sessionbil) {
        //         $q2->where('languageid', $sessionbil);
        //     }]);
        // }])->get();
        $wellnessTips = wellnessTipType::with(['wellnessTipTypesub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->get();
// dd($wellnessTips);
        return $wellnessTips;
    }

    public function healthAlerts()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $healthAlerts = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 4)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return $healthAlerts;
    }

    public function healthAlertSitecntl()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $healthAlertSitecntl = Sitecontrollabel::with(['sitelcontrollabel_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('id', 47)->where('status_id', 1)->first();

        return $healthAlertSitecntl;
    }

    public function Usefullinks()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $Usefullinks = Link::with(['link_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('linktypeid', 1)->where('delet_flag', 0)->orderBy('orderno', 'asc')->get();

        return $Usefullinks;
    }

    public function Importantlinks()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $Importantlinks = Link::with(['link_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('linktypeid', 2)->where('delet_flag', 0)->orderBy('orderno', 'asc')->get();

        return $Importantlinks;
    }

    public function mainfootercontactus()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainfootercontactus = Contactus::with(['contact_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->first();

        return $mainfootercontactus;
    }

    public function officelist($sessionbil)
    {

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('office_view_flag',1)->where('depcat',1)->where('department',1)->orderBy('orderno')->get();
        // return view('frontend.main.partialsOfficeContent', compact('officelists'))->render();

        return $officelists;
    }

    public function orgnazationlist($sessionbil)
    {

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('office_view_flag',1)->where('depcat',3)->where('department',1)->orderBy('orderno')->get();
        // return view('frontend.main.partialsOfficeContent', compact('officelists'))->render();

        return $officelists;
    }


    public function officeSeldepCat(Request $request)
    {
        $depCatId = $request->value;
        $text     = $request->text;
        $department = $request->department;
        $FormatTitle   =$request->title;
        $maindepartment       =$request->value;

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('depcat', $depCatId)->where('department',$department)->where('office_view_flag',1)->orderBy('orderno')->get();

        return view('frontend.main.partialsOfficeContent', compact('officelists','sessionbil','FormatTitle','maindepartment'))->render();

        // return response()->json(['html' => $html]);
    }

    public function officeSelorgCat(Request $request)
    {
        $depCatId = $request->value;
        $text     = $request->text;
        $department = $request->department;
        $FormatTitle   =$request->title;
        $maindepartment       =$request->value;

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $orgnazationlists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('depcat', $depCatId)->where('department',$department)->where('office_view_flag',1)->orderBy('orderno')->get();

        return view('frontend.main.partialsOfficeContentOrg', compact('orgnazationlists','sessionbil','FormatTitle','maindepartment'))->render();

        // return response()->json(['html' => $html]);
    }

    public function setbilingualvalmal(Request $request)
    {
        if ($request->ajax()) {
            Session::forget('bilingual');
            Session::put('bilingual', 2);
            $data = 'successfully set mal' . Session::get('bilingual');

            return response()->json(['success' =>  $data]);
            
        }
    }
    public function setbilingualval(Request $request)
    {
        if ($request->ajax()) {

            Session::forget('bilingual');
            Session::put('bilingual', 1);
            $data = 'successfully set eng' . Session::get('bilingual');
            return response()->json(['success' => 'successfully set eng']);

        }
    }

    private function siteControlLables($sessionbil)
    {

        $sitecontrollabels =  Sitecontrollabel::with(['sitelcontrollabel_sub' =>function($query) use($sessionbil){
            $query->where('languageid',$sessionbil);
        }])
        ->where('status_id', '1')
        ->get();

        return $sitecontrollabels;

    }

    public static function getSiteControlLabel($keyid)
    {
        $label = null;

        if (!Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $sitecontrollabel =  Sitecontrollabel::with(['sitelcontrollabel_sub' =>function($query) use($sessionbil){
            $query->where('languageid',$sessionbil);
        }])
        ->where('keyid', $keyid)
        ->where('status_id', '1')
        ->first();

        if($sitecontrollabel)
        {
            foreach($sitecontrollabel['sitelcontrollabel_sub'] as $details)
            {
                $label = $details->title;
            }
        }
    
       return $label;

    }
    public function articledetail($title,$id,Request $request)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('id',$id)->first();

        $Articletype = Articletype::with(['articletype_sub' => function($q1) use($sessionbil){
            $q1->where('languageid', $sessionbil);
        }])->where('id',$articles->articletype_id)->first();

        // $recentarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
        //     $query->where('languageid', $sessionbil);
        // }])->where('status_id', 1)
        //   ->orderBy('id', 'DESC')
        //   ->take(4) // Get latest 5 articles
        //   ->get();

        $recentarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)
          ->where('id', '!=', $id) // Exclude a specific ID
          ->where('articletype_id',$articles->articletype_id)
          ->orderBy('id', 'DESC')
        //   ->whereNotIn('articletype_id', [25, 24, 23, 22, 21, 19])
          ->take(3) // Get latest 4 articles (after exclusion)
          ->get();
   
        $tags_ids = $articles->articleval_sub[0]->tags_id;

        // Ensure tags_ids is not empty
        if (!empty($tags_ids)) {
            $values = explode(',', $tags_ids);
        
            // Fetch all related Keywordtagsub records in one query
            $keydatas = Keywordtagsub::where('languageid', $sessionbil)
                        ->whereIn('keywordtagid', $values)
                        ->get();
        } else {
            $keydatas = collect(); // Return an empty collection if no tags
        }
        // $currentUrl = Request::fullUrl();
            $currentUrl = $request->fullUrl();


        return view('frontend.main.articledetails', compact('mainsubmenu','sessionbil','articles','keydatas','Articletype','recentarticles','currentUrl'));
    }

    public function mainarticleview($id,Request $request)
    {
        
        $id = Crypt::decryptString($id);
 
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('id',$id)->first();

        $Articletype = Articletype::with(['articletype_sub' => function($q1) use($sessionbil){
            $q1->where('languageid', $sessionbil);
        }])->where('id',$articles->articletype_id)->first();

        // $recentarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
        //     $query->where('languageid', $sessionbil);
        // }])->where('status_id', 1)
        //   ->orderBy('id', 'DESC')
        //   ->take(4) // Get latest 5 articles
        //   ->get();

        $recentarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)
          ->where('id', '!=', $id) // Exclude a specific ID
          ->orderBy('id', 'DESC')
          ->take(4) // Get latest 4 articles (after exclusion)
          ->get();
        
        $tags_ids = $articles->articleval_sub[0]->tags_id;

        // Ensure tags_ids is not empty
        if (!empty($tags_ids)) {
            $values = explode(',', $tags_ids);
        
            // Fetch all related Keywordtagsub records in one query
            $keydatas = Keywordtagsub::where('languageid', $sessionbil)
                        ->whereIn('keywordtagid', $values)
                        ->get();
        } else {
            $keydatas = collect(); // Return an empty collection if no tags
        }
             $currentUrl = $request->fullUrl();
        

        return view('frontend.main.articledetails', compact('mainsubmenu','sessionbil','articles','keydatas','Articletype','recentarticles','currentUrl'));
    }


    public function awarddetails($title,$id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }

        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $id = Crypt::decryptString($id);

        $awards = Award::with([
                    'awardsub' => function ($query) use ($sessionbil) {
                        $query->where('languageid', $sessionbil);
                    },
                ])->with([
                    'awarditem' => function ($q1) use ($sessionbil) {
                      
                    },
                ])
            ->where('id', $id)
            ->first();
    
        return view('frontend.main.awarddetails', compact('mainsubmenu','sessionbil','awards'));
    }

    public function wellnessdetail($title,$id,$data)
    {

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }

        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $id = Crypt::decryptString($id);
        $data = Crypt::decryptString($data);
      
        if($data==2)
        {
            $wellnessTips = wellnessTip::with(['wellnessTipsub' => function ($query) use ($sessionbil) {
                // $query->select('alternatetext','subtitle','title')->where('delet_flag',0);
                $query->where('languageid', $sessionbil);
            }])->with(['wellnessTipType' => function ($q1) use ($sessionbil) {
                $q1->with(['wellnessTipTypesub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->where('id',$id)->first();
        }else{
            $wellnessTips = wellnessTip::with(['wellnessTipsub' => function ($query) use ($sessionbil) {
                // $query->select('alternatetext','subtitle','title')->where('delet_flag',0);
                $query->where('languageid', $sessionbil);
            }])->with(['wellnessTipType' => function ($q1) use ($sessionbil) {
                $q1->with(['wellnessTipTypesub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->where('wellnessTipTypeId',$id)->first();
        }
       
        $wellnessTipId = $wellnessTips->id;
        $wellnessTipTypeId = $wellnessTips->wellnessTipTypeId;

        $RelatwellnessTips = wellnessTip::with([
            'wellnessTipsub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
            'wellnessTipType' => function ($q1) use ($sessionbil) {
                $q1->with(['wellnessTipTypesub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }
        ])->whereNotIn('id', is_array($wellnessTipId) ? $wellnessTipId : [$wellnessTipId])
        ->where('wellnessTipTypeId',$wellnessTipTypeId)->get();
        


        return view('frontend.main.wellnessdetail', compact('mainsubmenu','sessionbil','wellnessTips','RelatwellnessTips'));
    }

    public function healthscapedetail($title,$id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
        $id = Crypt::decryptString($id);
        $mainhealthscapes = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('id',$id)->first();

        return view('frontend.main.healthscapedetail', compact('mainsubmenu','sessionbil','mainhealthscapes'));
    }

    public function dashboarddetail()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);

        $mainhealthscapes = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.main.dashboarddetail', compact('mainsubmenu','sessionbil','mainhealthscapes'));
    }
    public function dashboarddetailnew()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);

        $mainhealthscapes = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->get();

        return view('frontend.main.dashboarddetailnew', compact('mainsubmenu','sessionbil','mainhealthscapes'));
    }

    public function departmentsort(Request $request)
    {
        // $departments = DB::table('departments') // Adjust table name
        //     ->select('id', 'user_id', 'status_id', 'department', 'depafields', 'depcat', 'created_at', 'updated_at', 'logo', 'office_view_flag')
        //     ->get();
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $departmentId = $request->query('department'); // Get filter from query params

        $value = $request->value;
        if($value == 1) 
        {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                    $q4->where('languageid', $sessionbil);
                }]);
            }])->where('depcat', [1,2])->where('office_view_flag',1)->orderBy('orderno')->get();
            
        }else if($value == 2) {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                    $q4->where('languageid', $sessionbil);
                }]);
            }])->where('depcat', 1)->where('department',1)->where('office_view_flag',1)->orderBy('orderno')->get();
        }else if($value == 3)
        {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('depcat', 2)->where('department',2)->where('office_view_flag',1)->orderBy('orderno')->get();
        }

        return response()->json($officelists);
    }
    public function orgnazationsort(Request $request)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
   
        $departmentId = $request->query('department'); // Get filter from query params
    
        $value = $request->value;
        
        if($value == 1) 
        {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                    $q4->where('languageid', $sessionbil);
                }]);
            }])->whereIn('depcat', [3,4])->where('office_view_flag',1)->orderBy('orderno')->get();
            
        }else if($value == 2) {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                    $q2->where('languageid', $sessionbil);
                }]);
            }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                    $q4->where('languageid', $sessionbil);
                }]);
            }])->where('depcat', 3)->where('department',1)->where('office_view_flag',1)->orderBy('orderno')->get();
        }else if($value == 3)
        {
            $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
            $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                $q2->where('languageid', $sessionbil);
            }]);
        }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
            $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                $q4->where('languageid', $sessionbil);
            }]);
        }])->where('depcat', 4)->where('department',2)->where('office_view_flag',1)->orderBy('orderno')->get();
        }

        return response()->json($officelists);
    }
    public function SchemesProgrammes($id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
       
        $id = $id;
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
        
        $officelists = Office::with(['office_sub' => function ($query) use ($sessionbil) {
                                    $query->where('languageid', $sessionbil);
                                }])->with(['departmentfields' => function ($q1) use ($sessionbil) {
                                    $q1->with(['depfd_sub' => function ($q2) use ($sessionbil) {
                                        $q2->where('languageid', $sessionbil);
                                    }]);
                                }])->with(['departmentcat' => function ($q3) use ($sessionbil) {
                                    $q3->with(['depcat_sub' => function ($q4) use ($sessionbil) {
                                        $q4->where('languageid', $sessionbil);
                                    }]);
                                }])->where('office_view_flag',1)->whereIn('depcat', [1,2])->orderBy('orderno')->get();

        $ArticleDepartments = Article::where('status_id', 1)
                                ->with('articleval_sub', function ($query) use ($sessionbil) {
                                    $query->where('languageid', $sessionbil);
                                })
                                // ->whereHas('articledep', function ($q1) use ($id) {
                                //     $q1->where('officeId', $id);
                                // })
                                ->with(['articledep']) // No need to filter again in with()
                                ->orderBy('id', 'DESC')
                                ->get();

        if($id == "scheme")
        {
            $schemeProgms = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',13)->get();
        }
        elseif($id == "campaigns")
        {
            $schemeProgms = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',14)->get();
        }
        elseif($id == "medicaleducation")
        {
            $schemeProgms = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',15)->get();
        }


        return view('frontend.main.SchemesProgrammes', compact('mainsubmenu','sessionbil','officelists','id','schemeProgms'));
    }
    // public function SchemesdepartSel(Request $request)
    // {
    //     $depId=$request->depId;
    //     $value = $request->input('value'); // Get the value from the request
    //     $sessionbil = $request->input('sessionbil'); // Get session language ID
    
    //     // Determine filter conditions dynamically
    //     if ($value == 1) {
    //         $depcat = 1;
    //         $department = 1;
    //     } elseif ($value == 2) {
    //         $depcat = 2;
    //         $department = 2;
    //     } else {
    //         $depcat = [1, 2];
    //         $department = null; // Ignore department condition for 'else' case
    //     }
    
    //     // Fetch office list with relationships
    //     $officelists = Office::with([
    //         'office_sub' => function ($query) use ($sessionbil) {
    //             $query->where('languageid', $sessionbil);
    //         },
    //         'departmentfields.depfd_sub' => function ($query) use ($sessionbil) {
    //             $query->where('languageid', $sessionbil);
    //         },
    //         'departmentcat.depcat_sub' => function ($query) use ($sessionbil) {
    //             $query->where('languageid', $sessionbil);
    //         }
    //     ])
    //     ->where('depcat', $depcat)
    //     ->when($department, function ($query) use ($department) {
    //         return $query->where('department', $department);
    //     })
    //     ->where('office_view_flag', 1)
    //     ->orderBy('orderno')
    //     ->get();
    
    //     return response()->json(['data' => $officelists]);
    // }
public function SchemesdepartSel(Request $request)
{
    $value = $request->input('value'); // Get the value (1, 2, or other)
    $sessionbil = $request->input('sessionbil'); // Get language ID

    // Set department category and department conditionally
    if (in_array($value, [1, 2])) {
        $depcat = $value;
        $department = $value;
    } else {
        $depcat = [1, 2];
        $department = null;
    }

    // Fetch office list with necessary relationships
    $officelists = Office::with([
        'office_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        },
        'departmentfields.depfd_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        },
        'departmentcat.depcat_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }
    ])
    ->whereIn('depcat', is_array($depcat) ? $depcat : [$depcat])
    ->when($department, function ($query) use ($department) {
        return $query->where('department', $department);
    })
    ->where('office_view_flag', 1)
    ->orderBy('orderno')
    ->get();

    return response()->json(['data' => $officelists]);
}

    public function schemedetailpage($id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $id = Crypt::decryptString($id);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->where('id',$id)->first();

      
    
        $Relatedarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('id', '!=', $id)->where('articletype_id',13)->limit(8)->get();
       

        return view('frontend.main.schemedetailpage', compact('mainsubmenu','sessionbil','articleDet','Relatedarticles'));
    }
    public function iecmaterials()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $iecmaterials = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->where('gallerytypeid', 7)->where('status_id',1)->get();

        return view('frontend.main.gallerymain', compact('mainsubmenu','sessionbil','iecmaterials'));
    }

    public function iecmaterialsdetail($id,Request $request)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $id = Crypt::decryptString($id);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $iecmaterials = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->with(['gallery_item' => function($q1) use($sessionbil){

        }])->where('id',$id)->where('status_id',1)->first();
        // dd($iecmaterials);
        // $currentUrl = Request::fullUrl();
          $currentUrl = $request->fullUrl();
        $title = $iecmaterials->gallery_sub[0]->title;
        return view('frontend.main.iecmaterialsdetail', compact('mainsubmenu','sessionbil','iecmaterials','currentUrl','title'));
    }
    public function recentarticledetail($id)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);


        $articletypename = Articletype::with(['articletype_sub' => function ($q2) use($sessionbil){
            $q2->where('languageid', $sessionbil);
        }])->where('id',$id)->first();

        $articleTypeName = $articletypename->articletype_sub[0]->title ?? 'No Name Found';

        $recentarticles = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->with(['articletypeval'=> function($q1) use ($sessionbil){
            $q1->with(['articletype_sub' => function ($q2) use($sessionbil){
                $q2->where('languageid', $sessionbil);
            }]);
        }])->where('status_id', 1)
          ->where('articletype_id', '=', $id) // Exclude a specific ID
          ->orderBy('id', 'DESC')
          ->get();
// dd($recentarticles);
          return view('frontend.main.recentarticledetail', compact('mainsubmenu','sessionbil','recentarticles','articleTypeName'));
    }
    public function ambulancedetails()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);

        $ambulancedetails = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',17)->first();

        $recntambulancedetails = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',17)->get();
      
        return view('frontend.main.ambulancedetails', compact('mainsubmenu','sessionbil','ambulancedetails','recntambulancedetails'));
    }
    public function publiclogin()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
   
        return view('frontend.main.publiclogin', compact('mainsubmenu','sessionbil'));
    }
    public function publichome()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
      
        return view('frontend.main.publicregistration', compact('mainsubmenu','sessionbil'));
    }
    public function publicregistration()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
      
        return view('frontend.main.publicregistration', compact('mainsubmenu','sessionbil'));
    
    }
    public function storepublicregistration(Request $request)
    {
    // dd($request->all());
        try {
            $request->validate([
                'email'     => app('App\Http\Controllers\Commonfunctions')->emailId_check(),
                'pass'  => 'required | min:8',
                'mobile'    => app('App\Http\Controllers\Commonfunctions')->mobileNum_check(),
                'name' => app('App\Http\Controllers\Commonfunctions')->getEntitlereg(),
            ], [
                'name.required' => 'Name is required',
                'name.min' => 'Name  minimum length is 2',
                'name.max' => 'Name  maximum length is 50',
                'name.regex' => 'Invalid characters not allowed for name',

                'mobile.required' => 'Mobile number is required',
                'mobile.min' => 'Mobile number  minimum length is 2',
                'mobile.max' => 'Mobile number  maximum length is 10',
                'mobile.regex' => 'Invalid characters not allowed for Mobile number',

            ]);

            $request->input();
            $userchecklisttitle =  User::where('email', $request->email)->exists() ? 1 : 0;
          
            if ($userchecklisttitle   != 0) {
                $error = "This Title is already existing";
                return redirect()->back()->withInput()->with('error', 'User email already used');
            } else {
              
                    $storeinfo = new user([
                        'name' => $request->email,
                        'fullname' => $request->fullname,
                        'mobile' => $request->mobile,
                        'email' => $request->email,
                        'role_id' => 10,
                        'password' => Hash::make($request->password),
                        'status_id' => 1,
                    ]);
              
                $storedetails = $storeinfo->save();

                return redirect()->route('main.publicregistration')->with('success', 'created successfully');
            }
        } catch (ModelNotFoundException $exception) {
            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();
            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR' . $data->id);
        }
    }
    public function FinancialAid()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');

        $mainsubmenu = $this->mainmenu($sessionbil);
   
        $FinancialAids = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 7)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->get();

         

        return view('frontend.main.FinancialAid', compact('mainsubmenu','sessionbil','FinancialAids'));
    }
    public function Publications($id='')
    {
        // dd($id);
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);


        if (empty($id)) {

            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['gallery_item' => function($q1) use($sessionbil){

            }])
            ->where('gallerytypeid', 5)
            ->where('status_id', 1)
            ->latest()
            ->first();
        }else{
            $id = Crypt::decryptString($id);
            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['gallery_item' => function($q1) use($sessionbil){

            }])
            ->where('gallerytypeid', 5)
            ->where('status_id', 1)
            ->where('id',$id)
            ->first();
            
        }

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        // $brouchers = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
        //     $query->where('languageid', $sessionbil);
        // }])->with(['gallery_item' => function($q1) use($sessionbil){

        // }])->where('gallerytypeid', 5)->where('status_id',1)->limit(5)->get();

            $brouchers = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['gallery_item' => function($q1) use($sessionbil){

            }])
            ->where('status_id', 1)
            ->whereNotIn('id', [$id])
            ->where('gallerytypeid', 5)->where('status_id',1)->limit(5)->get();


        // dd($Latestpublication);
        return view('frontend.main.publications', compact('mainsubmenu','sessionbil','brouchers','Latestpublication'));
    }
    public function Brouchers($id='')
    {
        // dd($id);
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);


        if (empty($id)) {

            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])
            ->where('gallerytypeid', 6)
            ->where('status_id', 1)
            ->latest()
            ->first();
        }else{
            $id = Crypt::decryptString($id);
            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])
            ->where('gallerytypeid', 6)
            ->where('status_id', 1)
            ->where('id',$id)
            ->first();
            
        }


        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $brouchers = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->with(['gallery_item' => function($q1) use($sessionbil){

        }])->where('gallerytypeid', 6)->where('status_id',1)->limit(5)->get();


        // dd($Latestpublication);
        return view('frontend.main.brouchers', compact('mainsubmenu','sessionbil','brouchers','Latestpublication'));
    }
    public function Posters($id='')
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $iecmaterials = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->where('gallerytypeid', 7)->where('status_id',1)->get();

        if (empty($id)) {

            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['gallery_item' => function($q1) use($sessionbil){

            }])
            ->where('gallerytypeid', 7)
            ->where('status_id', 1)
            ->latest()
            ->first();
        }else{
            $id = Crypt::decryptString($id);
            $Latestpublication = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])->with(['gallery_item' => function($q1) use($sessionbil){

            }])
            ->where('gallerytypeid', 7)
            ->where('status_id', 1)
            ->where('id',$id)
            ->first();
            
        }

        return view('frontend.main.posters', compact('mainsubmenu','sessionbil','iecmaterials','Latestpublication'));
    } 
    public function onlineservices($id='')
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $onlineservices = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->where('articletype_id',26)->get();

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        return view('frontend.main.onlineservices', compact('mainsubmenu','sessionbil','onlineservices','articleDet'));
    }
    public function photogallery()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $galliers = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->where('gallerytypeid', 1)->where('status_id',1)->get();

        return view('frontend.main.galliers', compact('mainsubmenu','sessionbil','galliers'));
    }
    public function videogallery()
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $galliers = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->where('gallerytypeid', 2)->where('status_id',1)->get();

        return view('frontend.main.galliersvideo', compact('mainsubmenu','sessionbil','galliers'));
    }
    public function gallerydetail($id,Request $request)
    {
      
         if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $id = Crypt::decryptString($id);

        $articleDet = Article::with(['articleval_sub' => function ($query) use ($sessionbil) {
            $query->where('languageid', $sessionbil);
        }])->where('status_id', 1)->orderBy('id', 'DESC')->with(['office' =>function($q1) use($sessionbil){
            $q1->with(['office_sub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }]);
        } ])->first();

        $iecmaterials = Gallery::with(['gallery_sub' => function ($query) use ($sessionbil){
            $query->where('languageid', $sessionbil);
        }])->with(['gallery_item' => function($q1) use($sessionbil){

        }])->where('gallerytypeid', 1)->where('id',$id)->where('status_id',1)->first();
         
        // $currentUrl = Request::fullUrl();
          $currentUrl = $request->fullUrl();
        $title = $iecmaterials->gallery_sub[0]->title;
        return view('frontend.main.iecmaterialsdetail', compact('mainsubmenu','sessionbil','iecmaterials','currentUrl','title'));
    }
    public function financialaiditem($id)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $announcementitem = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 7)
            ->where('status_id', 1)
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        $RelatedFinAids = Announcement::with(['announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])
            ->whereNotIn('id', [$id])
            ->where('announcementtype', 7)->where('status_id',1)->limit(10)->get();

        return view('frontend.main.financialaiditem', compact('mainsubmenu', 'announcementitem','sessionbil','RelatedFinAids'));
    }

public function financialaiditemPDF($id)
{

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $id = Crypt::decryptString($id);
        $announcement = Announcement::with('announcesub')->findOrFail($id);
        $sub = $announcement->announcesub->first(); // assuming single language entry

        $pdf = Pdf::loadView('frontend.main.financialaiditempdf', [
            'title' => $sub->title ?? '',
            'description' => $sub->description ?? '',
            'date' => \Carbon\Carbon::parse($announcement->s_date)->format('d F Y'),
        ]);

        $filename = 'announcement_' . $announcement->id . '.pdf';

        return $pdf->download($filename);

}
    public function SchemesMenu($id)
    {
        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);

        $SchemesDatas = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 8)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            ->get();

        $RelatedSchemes = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 8)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            // ->whereNotIn('id', [$id])
            ->get();
       
        return view('frontend.main.schememenu', compact('mainsubmenu','sessionbil','SchemesDatas','FinancialAids'));

    }
    public function Schemes($id='')
    {
          if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        
        if($id == 'SchemesforMothers')
        {
            // $SchemesDatas = Announcement::with([
            //         'announcesub' => function ($query) use ($sessionbil) {
            //             $query->where('languageid', $sessionbil);
            //         },
            //     ])
            //         ->where('announcementtype', 8)
            //         ->where('schemetypeId',1)
            //         ->where('status_id', 1)
            //         ->orderBy('id', 'DESC')
            //         ->get();
            $announcementitem = Announcement::with([
                            'announcesub' => function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            },
                        ])
                            ->where('announcementtype', 8)
                            ->where('status_id', 1)
                            ->where('id', 40)
                            ->orderBy('id', 'DESC')
                            ->first();       
        }else if($id == 'SchemesforChildren'){
                // $SchemesDatas = Announcement::with([
                //                     'announcesub' => function ($query) use ($sessionbil) {
                //                         $query->where('languageid', $sessionbil);
                //                     },
                //                 ])
                //                     ->where('announcementtype', 8)
                //                     ->where('schemetypeId',2)
                //                     ->where('status_id', 1)
                //                     ->orderBy('id', 'DESC')
                //                     ->get();
                $announcementitem = Announcement::with([
                            'announcesub' => function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            },
                        ])
                            ->where('announcementtype', 8)
                            ->where('status_id', 1)
                            ->where('id', 41)
                            ->orderBy('id', 'DESC')
                            ->first();   
        }else if($id == 'OtherSchemes'){
                // $SchemesDatas = Announcement::with([
                //                     'announcesub' => function ($query) use ($sessionbil) {
                //                         $query->where('languageid', $sessionbil);
                //                     },
                //                 ])
                //                     ->where('announcementtype', 8)
                //                     ->where('schemetypeId',3)
                //                     ->where('status_id', 1)
                //                     ->orderBy('id', 'DESC')
                //                     ->get();
                $announcementitem = Announcement::with([
                            'announcesub' => function ($query) use ($sessionbil) {
                                $query->where('languageid', $sessionbil);
                            },
                        ])
                            ->where('announcementtype', 8)
                            ->where('status_id', 1)
                            ->where('id', 42)
                            ->orderBy('id', 'DESC')
                            ->first();   
        }
  

        $RelatedSchemes = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 8)
            ->where('status_id', 1)
            ->orderBy('id', 'DESC')
            // ->whereNotIn('id', [$id])
            ->get();
            $title= $id;
            
            return view('frontend.main.schemeitem', compact('mainsubmenu', 'announcementitem','sessionbil','RelatedSchemes','title'));

        // return view('frontend.main.schememenu', compact('mainsubmenu','sessionbil','SchemesDatas','RelatedSchemes','title'));
    }
    public function Sechmeitem($id,$title)
    {
        $id = Crypt::decryptString($id);

        if (! Session::has('bilingual')) {
            Session::put('bilingual', 1);
        }
        $sessionbil = Session::get('bilingual');
        $mainsubmenu = $this->mainmenu($sessionbil);
        $announcementitem = Announcement::with([
            'announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            },
        ])
            ->where('announcementtype', 8)
            ->where('status_id', 1)
            ->where('id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        $RelatedFinAids = Announcement::with(['announcesub' => function ($query) use ($sessionbil) {
                $query->where('languageid', $sessionbil);
            }])
            ->whereNotIn('id', [$id])
            ->where('announcementtype', 8)->where('status_id',1)->limit(10)->get();

        return view('frontend.main.schemeitem', compact('mainsubmenu', 'announcementitem','sessionbil','RelatedFinAids','title'));
    }
}
