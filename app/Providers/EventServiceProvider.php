<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Modules\MasterPage\Entities\MasterPage;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
       

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...

            $event->menu->add(
            [
                'text' => Auth::user()->username.' - '.Auth::user()->name,
                'url' => 'profile',
                'icon' => 'fas fa-fw fa-user-circle',
            ],
        );

            $event->menu->add('MENU');
            $event->menu->add(
                [
                    'text' => 'Home',
                    'url' => 'dashboard',
                    'icon' => 'fas fa-fw fa-home',
                ],
               
            );
          
            $user_url = Auth::user()->getPermissionsViaRoles()->pluck('name');
         
            $url = [];
            foreach($user_url as $u)
            {
                if(preg_match("/index/i", $u)) {
                    
                    $url[]=substr($u,0,strpos($u, '.'));

                }
            }

            $page = MasterPage::where('status', '1')->where('parent', null)->orderby('urutan', 'asc')->get();

            if (count($page) > 0) {
                foreach ($page as $p) {
                    if ($p->url != '#') {
                        $event->menu->add([
                            'text' => $p->nama,
                            'url' => $p->url,
                            'icon' => $p->icon,
                        ]);
                    } else {
                        if (count($p->childPage) > 0) {
                            $submenu = [];
                            foreach ($p->childPage as $cp) {

                                if(in_array($cp->url,$url))
                                {
                                    $sm = ['text' => $cp->nama, 'url'  => $cp->url];
                                    array_push($submenu, $sm);
                                }
                                
                            }
                            if(count($submenu) > 0 )
                            {
                            $event->menu->add([
                                'text' => $p->nama,
                                'url' => $p->url,
                                'icon' => $p->icon,
                                'submenu' => $submenu,
                            ]);
                        }
                        }
                    }
                }
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
