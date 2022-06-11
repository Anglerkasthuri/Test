<aside class="main-sidebar sidebar-primary elevation-1">
    <div class="p-2 brand-logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('img/app-logo-wt-sm.png') }}" alt="" class="brand-image">
            <span class="brand-text font-weight-light text-white">
               TEXILA AMERICAN UNIVERSIRY
            </span>
        </a>
    </div>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent nav-compact" data-widget="treeview" role="menu"
                data-accordion="false">
                @php
                    
                    $menus = [
                        //  Master
                        'dashboard' => [
                            'title' => 'Dashboard',
                            'route' => 'student.dashboard',
                            'icon' => 'fas fa-wrench',
                            'parent' => null,
                            'permission' => null,
                        ],
                    

                    ];
                    
                    $addedAsChildren = [];
                    
                    foreach ($menus as $id => &$menuItem) {
                        // note that we use a reference so we don't duplicate the array
    if (!empty($menuItem['parent'])) {
        $addedAsChildren[] = $id;
        if (!isset($menus[$menuItem['parent']]['children'])) {
            $menus[$menuItem['parent']]['children'] = [$id => &$menuItem];
        } else {
            $menus[$menuItem['parent']]['children'][$id] = &$menuItem;
        }
    }
    unset($menuItem['parent']); // we don't need this any more
                    }
                    
                    unset($menuItem); // unset the reference
                    foreach ($addedAsChildren as $itemID) {
                        unset($menus[$itemID]); // remove it from root so it's only in the ['children'] subarray
}

function makeTree($menu)
{
    $tree = '<ul class="nav nav-treeview">';
    foreach ($menu as $id => $menuItem) {
        $active_class = '';
        if (
            empty($menuItem['permission']) ||
            (isset($menuItem['permission']) &&
                auth()
                    ->user()
                    ->hasAnyPermission($menuItem['permission']))
        ) {
            if (isset($menuItem['url'])) {
                $setUrl = $menuItem['url'] ?? null;
            } elseif (isset($menuItem['route'])) {
                $setUrl = route($menuItem['route']);
            } else {
                $setUrl = '#';
            }

            if (isset($menuItem['active_route'])) {
                $active_class = in_array(Route::currentRouteName(), $menuItem['active_route']) ? 'active' : '';
            }

            $tree .=
                '<li class="nav-item">
                                            <a href="' .
                                    $setUrl .
                                    '" target="' .
                                    ($menuItem['target'] ?? null) .
                                    '" class="nav-link parant-link '.$active_class.'">
                                                        <i class=" '. ( $menuItem['icon'] ?? null ) .'  nav-icon"></i>';
            $tree .=
                '<p>
                                                        ' .
                ($menuItem['title'] ?? null) .
                '
                                                        ' .
                (!empty($menuItem['children']) ? '<i class="right fas fa-angle-left"></i>' : '') .
                '
                                                    </p></a>';
            if (!empty($menuItem['children'])) {
                $tree .= makeTree($menuItem['children']);
            }
            $tree .= '</li>';
        }
    }
    return $tree . '</ul>';
}

foreach ($menus as $menu) {
    if (
        empty($menu['permission']) ||
        (isset($menu['permission']) &&
            auth()
                ->user()
                ->hasAnyPermission($menu['permission']))
    ) {
        if (isset($menu['url'])) {
            $setUrl = $menu['url'] ?? null;
        } elseif (isset($menu['route'])) {
            $setUrl = route($menu['route']) ?? null;
        } else {
            $setUrl = '#';
        }

        if (isset($menu['active_route'])) {
            $active_class = in_array(Route::currentRouteName(), $menuItem['active_route']) ? 'active' : '';
        }

        echo '<li class="nav-item">
                                            <a href="' .
                                $setUrl .
                                '" target="' .
                                ($menu['target'] ?? null) .
                                '" class="nav-link parant-link ">
                                                <i class="'.($menu['icon'] ?? null ).' nav-icon"></i>
                                                <p>' .
            ($menu['title'] ?? null) .
            (isset($menu['children']) ? '<i class="right fas fa-angle-left"></i>' : '') .
            '</p></a>';
        if (isset($menu['children'])) {
            echo makeTree($menu['children']);
        }
        echo '</li>';
                        }
                    }
                @endphp
                {{-- @php
    $route = Route::current(); // Illuminate\Routing\Route
    $name = Route::currentRouteName(); // string
    dump($name);
    dump( url()->current());
 
    // Get the current URL including the query string...
    dump( url()->full());
    
    // Get the full URL for the previous request...
    dump( url()->previous());
    @endphp --}}


            </ul>
        </nav>
    </div>
</aside>