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
                        'master' => [
                            'title' => 'Masters',
                            'icon' => 'fas fa-wrench',
                            'parent' => null,
                            //'permission' => ['academic-master-list', 'program-list','common-master-list','location-master-list'],
                            'permission' => null,
                        ],
                    
                        //  Master / Academic Master
                        'academic_master' => [
                            'title' => 'Academic Master',
                            'icon' => 'fas fa-book',
                            'parent' => 'master',
                            'permission' => ['academic-master-list', 'program-list', 'course-list'],
                        ],
                        'program' => [
                            'title' => 'Program',
                            'route' => 'program',
                            'icon' => 'fas fa-chalkboard-teacher',
                            'parent' => 'academic_master',
                            'permission' => 'program-list',
                            'active_route' => ['program.view'],
                        ],
                        'course' => [
                            'title' => 'Course',
                            'route' => 'course',
                            'icon' => 'fas fa-chalkboard-teacher',
                            'parent' => 'academic_master',
                            'permission' => 'course-list',
                        ],
                        'campus' => [
                            'title' => 'Campus',
                            'route' => 'campus',
                            'icon' => 'far fa-building',
                            'parent' => 'academic_master',
                            //'target' => 'blank', //For Reference
                            'permission' => 'academic-master-list',
                        ],
                        'program_category' => [
                            'title' => 'Program Category',
                            'route' => 'program-category',
                            'icon' => 'fas fa-chalkboard-teacher',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'program_subcategory' => [
                            'title' => 'Program Subcategory',
                            'route' => 'program-sub-category',
                            'icon' => 'fas fa-chalkboard',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'program_duration' => [
                            'title' => 'Program Duration',
                            'route' => 'program-duration',
                            'icon' => 'far fa-clock',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'program_level' => [
                            'title' => 'Program Level',
                            'route' => 'program-level',
                            'icon' => 'fas fa-line-chart',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'program_group' => [
                            'title' => 'Program Group',
                            'route' => 'program-group',
                            'icon' => 'far fa-clone',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'accreditation' => [
                            'title' => 'Accreditation',
                            'route' => 'accreditation',
                            'icon' => 'far fa-id-badge',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'academic_year' => [
                            'title' => 'Academic Year',
                            'route' => 'academic-year',
                            'icon' => 'far fa-hourglass',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'academic_pattern' => [
                            'title' => 'Academic Pattern',
                            'route' => 'academic-pattern',
                            'icon' => 'fas fa-inbox',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        'degree_awarding_body' => [
                            'title' => 'Degree Awarding Body',
                            'route' => 'degree-awarding-body',
                            'icon' => 'far fa-bell',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                    
                        'combined_intake' => [
                            'title' => 'Combined Intake',
                            'route' => 'combined-intake',
                            'icon' => 'fas fa-chalkboard-teacher',
                            'parent' => 'academic_master',
                            'permission' => 'academic-master-list',
                        ],
                        // Master / Enrollment Masters
                        'enrollment_master' => [
                            'title' => 'Enrollment Master',
                            'url' => '#',
                            'icon' => 'far fa-bookmark',
                            'parent' => 'master',
                            'permission' => 'enrollment-master-list',
                        ],
                        'grade_category' => [
                            'title' => 'Grade Category',
                            'route' => 'grade-category',
                            'icon' => 'fas fa-black-tie',
                            'parent' => 'enrollment_master',
                            'permission' => 'grade-category-list',
                        ],
                        'exam_pattern' => [
                            'title' => 'Exam Pattern',
                            'route' => 'exam-pattern',
                            'icon' => 'fa fa-hand-lizard',
                            'parent' => 'enrollment_master',
                            'permission' => 'exam-pattern-list',
                            'active_route' => ['exam-pattern.setting'],
                        ],
                    
                        // Master / Academic Component
                        'academic_component_master' => [
                            'title' => 'Academic Component',
                            'url' => '#',
                            'icon' => 'fa fa-graduation-cap',
                            'parent' => 'master',
                            'permission' => 'enrollment-master-list',
                        ],
                    
                        'academic_component_category' => [
                            'title' => 'Component Category',
                            'route' => 'academic-component-category',
                            'icon' => 'fa fa-eyedropper',
                            'parent' => 'academic_component_master',
                            'permission' => 'enrollment-master-list',
                        ],
                    
                        'academic_component_group' => [
                            'title' => 'Component Group',
                            'route' => 'academic-component-group',
                            'icon' => 'fa fa-map-signs',
                            'parent' => 'academic_component_master',
                            'permission' => 'enrollment-master-list',
                        ],
                        'academic_component_type' => [
                            'title' => 'Component Type',
                            'route' => 'academic-component-type',
                            'icon' => 'fa fa-hand-lizard',
                            'parent' => 'academic_component_master',
                            'permission' => 'enrollment-master-list',
                        ],
                        'grade_type' => [
                            'title' => 'Grade Type',
                            'route' => 'grade-type',
                            'icon' => 'fa fa-fire-extinguisher',
                            'parent' => 'academic_component_master',
                            'permission' => 'enrollment-master-list',
                        ],
                    
                        // Master / Location Master
                        'location_master' => [
                            'title' => 'Location Master',
                            'url' => '#',
                            'icon' => 'far fa-compass',
                            'parent' => 'master',
                            'permission' => 'location-master-list',
                        ],
                        'country' => [
                            'title' => 'Country',
                            'route' => 'country',
                            'icon' => 'fas fa-globe',
                            'parent' => 'location_master',
                            'permission' => 'location-master-list',
                        ],
                    
                        // Master / Common Masters
                        'common_master' => [
                            'title' => 'Common Master',
                            'icon' => 'far fa-lightbulb',
                            'parent' => 'master',
                            'permission' => 'common-master-list',
                        ],
                        'master_group ' => [
                            'title' => 'Master Group ',
                            'route' => 'master-group',
                            'icon' => 'fas fa-server',
                            'parent' => 'common_master',
                            'permission' => 'common-master-list',
                        ],
                        'master_category' => [
                            'title' => 'Master Category',
                            'route' => 'master-category',
                            'icon' => 'fas fa-sitemap',
                            'parent' => 'common_master',
                            'permission' => 'common-master-list',
                        ],
                        'master_option' => [
                            'title' => 'Master Option',
                            'route' => 'master-option',
                            'icon' => 'far fa-circle',
                            'parent' => 'common_master',
                            'permission' => 'common-master-list',
                            'active_route' => ['master-option.category'],
                        ],
                        'system_model' => [
                            'title' => 'System Model',
                            'route' => 'system-model',
                            'icon' => 'fas fa-cubes',
                            'parent' => 'common_master',
                            'permission' => 'common-master-list',
                        ],
                    
                        // Master / Access
                        'access' => [
                            'title' => 'Access',
                            'icon' => 'fas fa-lock',
                            'parent' => 'master',
                        ],
                        'permission' => [
                            'title' => 'Permission',
                            'route' => 'permission.index',
                            'icon' => 'fas fa-unlock',
                            'parent' => 'access',
                            'permission' => null,
                        ],
                        'role' => [
                            'title' => 'Role',
                            'route' => 'role',
                            'icon' => 'far fa-user',
                            'parent' => 'access',
                            'permission' => null,
                            'active_route' => ['role.permissions.index'],
                        ],
                        'user' => [
                            'title' => 'User',
                            'route' => 'user',
                            'icon' => 'fas fa-users',
                            'parent' => 'access',
                            'permission' => null,
                            'active_route' => ['user.permissions.index'],
                        ],
                        // Master / Mail
                        'mail' => [
                            'title' => 'Mail',
                            'icon' => 'far fa-envelope',
                            'parent' => 'master',
                        ],
                        'mail-template' => [
                            'title' => 'Template',
                            'route' => 'mail-template',
                            'icon' => 'far fa-folder-open',
                            'parent' => 'mail',
                            'permission' => 'mail-template-list',
                        ],

                        // Enrollments
                        'enrollments' => [
                            'title' => 'Enrollments',
                            'icon' => 'fas fa-history',
                            'parent' => null,
                            'permission' => ['enrollment-list'],
                        ],
                        'enrollment' => [
                            'title' => 'Enrollment',
                            'route' => 'enrollment',
                            'icon' => 'fas fa-history',
                            'parent' => 'enrollments',
                            'permission' => null,
                            'active_route' => ['enrollment.course', 'enrollment.student'],
                        ],
                    
                        // Students
                        'students' => [
                            'title' => 'Students',
                            'icon' => 'fas fa-user',
                            'parent' => null,
                            'permission' => ['student-list'],
                        ],
                        'student' => [
                            'title' => 'Student',
                            'route' => 'student',
                            'icon' => 'fas fa-graduation-cap',
                            'parent' => 'students',
                            'permission' => null,
                        ],
                    
                        // Staffs
                        'staffs' => [
                            'title' => 'Staffs',
                            'icon' => 'fas fa-user-tie',
                            'parent' => null,
                            'permission' => ['staff-list'],
                        ],
                        'staff' => [
                            'title' => 'Staff',
                            'route' => 'staff',
                            'icon' => 'fa fa-user-group',
                            'parent' => 'staffs',
                            'permission' => null,
                        ],
                    
                        // Form
                        'Forms' => [
                            'title' => 'Forms',
                            'icon' => 'fas fa-table',
                            'parent' => null,
                        ],
                        'form' => [
                            'title' => 'Form',
                            'route' => 'form',
                            'icon' => 'far fa-check-square',
                            'parent' => 'Forms',
                            'permission' => null,
                            'active_route' => ['form-preview', 'form-field'],
                        ],
                    
                        // Report
                        'report' => [
                            'title' => 'Report',
                            'icon' => 'fas fa-file',
                            'parent' => null,
                        ],
                        'log' => [
                            'title' => 'Log',
                            'route' => 'log',
                            'icon' => 'fas fa-history',
                            'parent' => 'report',
                            'permission' => null,
                            'active_route' => ['model-log'],
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
                (auth()
                    ->user()
                    ->hasAnyPermission($menuItem['permission']) ||
                    auth()->user()->is_super_admin))
        ) {
            if (isset($menuItem['url'])) {
                $setUrl = $menuItem['url'] ?? null;
            } elseif (isset($menuItem['route'])) {
                if (Route::has($menuItem['route'])) {
                    $setUrl = route($menuItem['route']);
                } else {
                    $setUrl = '#';
                    $active_class .= ' text-danger ';
                }
            } else {
                $setUrl = '#';
            }

            if (isset($menuItem['active_route'])) {
                $active_class .= in_array(Route::currentRouteName(), $menuItem['active_route']) ? 'active' : '';
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
            (auth()
                ->user()
                ->hasAnyPermission($menu['permission']) ||
                auth()->user()->is_super_admin))
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
