<?php

namespace App\Http\Controllers;

use App\Helpers\CalHelper;
use App\Models\Blog\Post;
use App\Models\Master\Product;
use App\Models\Project;
use App\Models\Faththink;
use App\Models\User;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Dashboard stats
     */
    public function stat()
    {
        return [
            [
                'title' => 'Projects',
                'count' => Project::count(),
                'direction' => 'up',
                'percent' => 1.5,
                'icon' => 'fas fa-user-plus',
                'color' => 'bg-success',
                'progress' => '<svg class="w-full" viewBox="0 0 1000 200"   xmlns="http://www.w3.org/2000/svg" >      <path d="M 0,133.86695711360943 C 25,118.32720364131744 75,66.52490216321823 125,56.16818975214948 C 175,45.811477341080746 200,72.4707573747341 250,82.08339505826574 C 300,91.69603274179737 325,105.16510573320471 375,104.23137816980763 C 425,103.29765060641056 450,77.09024792104188 500,77.4147572412804 C 550,77.73926656151893 575,98.83643154627106 625,105.85392477100028 C 675,112.8714179957295 700,127.47265377945222 750,112.50222336492648 C 800,97.53179295040076 825,21.638034012825432 875,31.00177269837167 C 925,40.36551138391791 975,133.65708797380046 1000,159.32091679265767,L 1000 200,L 0 200Z" fill="#21c55d1a" />   <path d="M 0,133.86695711360943 C 25,118.32720364131744 75,66.52490216321823 125,56.16818975214948 C 175,45.811477341080746 200,72.4707573747341 250,82.08339505826574 C 300,91.69603274179737 325,105.16510573320471 375,104.23137816980763 C 425,103.29765060641056 450,77.09024792104188 500,77.4147572412804 C 550,77.73926656151893 575,98.83643154627106 625,105.85392477100028 C 675,112.8714179957295 700,127.47265377945222 750,112.50222336492648 C 800,97.53179295040076 825,21.638034012825432 875,31.00177269837167 C 925,40.36551138391791 975,133.65708797380046 1000,159.32091679265767" fill="none" stroke="#21C55D" stroke-width="1px" />   <g>   		<circle cx="0" cy="133.86695711360943" r="6" fill="#21C55D" />,		<circle cx="125" cy="56.16818975214948" r="6" fill="#21C55D" />,		<circle cx="250" cy="82.08339505826574" r="6" fill="#21C55D" />,		<circle cx="375" cy="104.23137816980763" r="6" fill="#21C55D" />,		<circle cx="500" cy="77.4147572412804" r="6" fill="#21C55D" />,		<circle cx="625" cy="105.85392477100028" r="6" fill="#21C55D" />,		<circle cx="750" cy="112.50222336492648" r="6" fill="#21C55D" />,		<circle cx="875" cy="31.00177269837167" r="6" fill="#21C55D" />,		<circle cx="1000" cy="159.32091679265767" r="6" fill="#21C55D" />   </g> </svg>'
            ],
            [
                'title' => 'Products',
                'count' => Product::count(),
                'direction' => 'down',
                'percent' => 0.4,
                'icon' => 'fas fa-user-tie',
                'color' => 'bg-primary dark:bg-gray-700',
                'progress' => '<svg class="w-full" viewBox="0 0 1000 200"   xmlns="http://www.w3.org/2000/svg" >      <path d="M 0,73.13090010944751 C 25,78.03734782223768 75,86.10350334298296 125,97.66313867339836 C 175,109.22277400381378 200,130.95198774755175 250,130.92907676152458 C 300,130.9061657754974 325,107.95522704632492 375,97.54858374326258 C 425,87.14194044020024 450,82.01988433362379 500,78.89586024621292 C 550,75.77183615880205 575,87.07905858014153 625,81.92846330620824 C 675,76.77786803227497 700,40.33315784482946 750,53.142883876546506 C 800,65.95260990826355 825,129.3919044235398 875,145.97709346479348 C 925,162.56228250604715 975,138.0504819592106 1000,136.0688290828149,L 1000 200,L 0 200Z" fill="#fa41381a" />   <path d="M 0,73.13090010944751 C 25,78.03734782223768 75,86.10350334298296 125,97.66313867339836 C 175,109.22277400381378 200,130.95198774755175 250,130.92907676152458 C 300,130.9061657754974 325,107.95522704632492 375,97.54858374326258 C 425,87.14194044020024 450,82.01988433362379 500,78.89586024621292 C 550,75.77183615880205 575,87.07905858014153 625,81.92846330620824 C 675,76.77786803227497 700,40.33315784482946 750,53.142883876546506 C 800,65.95260990826355 825,129.3919044235398 875,145.97709346479348 C 925,162.56228250604715 975,138.0504819592106 1000,136.0688290828149" fill="none" stroke="#fa4138" stroke-width="1px" />   <g>   		<circle cx="0" cy="73.13090010944751" r="6" fill="#fa4138" />,		<circle cx="125" cy="97.66313867339836" r="6" fill="#fa4138" />,		<circle cx="250" cy="130.92907676152458" r="6" fill="#fa4138" />,		<circle cx="375" cy="97.54858374326258" r="6" fill="#fa4138" />,		<circle cx="500" cy="78.89586024621292" r="6" fill="#fa4138" />,		<circle cx="625" cy="81.92846330620824" r="6" fill="#fa4138" />,		<circle cx="750" cy="53.142883876546506" r="6" fill="#fa4138" />,		<circle cx="875" cy="145.97709346479348" r="6" fill="#fa4138" />,		<circle cx="1000" cy="136.0688290828149" r="6" fill="#fa4138" />   </g> </svg>'
            ],
            [
                'title' => 'Post',
                'count' => Post::count(),
                'direction' => 'up',
                'percent' => 0.8,
                'icon' => 'fas fa-user-times',
                'color' => 'bg-danger dark:bg-gray-700',
                'progress' => '<svg class="w-full" viewBox="0 0 1000 200"   xmlns="http://www.w3.org/2000/svg" >      <path d="M 0,145.04027057543067 C 25.000000000000004,122.09956068862186 75,49.14016459425434 125,30.336721141386647 C 175,11.533277688518972 200,35.85187309039629 250,51.0230533110923 C 300,66.1942335317883 325,108.90869602136554 375,106.19262224486668 C 425,103.47654846836782 450,47.21182639140862 500,37.442684428598 C 550,27.673542465787385 575,34.108183094980184 625,57.3469124308136 C 675,80.58564176664703 700,136.78707812321164 750,153.63633110776513 C 800,170.48558409231865 825,153.672185456545 875,141.59317735358118 C 925,129.51416925061736 975,102.91166794507309 1000,93.24129059294606,L 1000 200,L 0 200Z" fill="#21c55d1a" />   <path d="M 0,145.04027057543067 C 25.000000000000004,122.09956068862186 75,49.14016459425434 125,30.336721141386647 C 175,11.533277688518972 200,35.85187309039629 250,51.0230533110923 C 300,66.1942335317883 325,108.90869602136554 375,106.19262224486668 C 425,103.47654846836782 450,47.21182639140862 500,37.442684428598 C 550,27.673542465787385 575,34.108183094980184 625,57.3469124308136 C 675,80.58564176664703 700,136.78707812321164 750,153.63633110776513 C 800,170.48558409231865 825,153.672185456545 875,141.59317735358118 C 925,129.51416925061736 975,102.91166794507309 1000,93.24129059294606" fill="none" stroke="#21C55D" stroke-width="1px" />   <g>   		<circle cx="0" cy="145.04027057543067" r="6" fill="#21C55D" />,		<circle cx="125" cy="30.336721141386647" r="6" fill="#21C55D" />,		<circle cx="250" cy="51.0230533110923" r="6" fill="#21C55D" />,		<circle cx="375" cy="106.19262224486668" r="6" fill="#21C55D" />,		<circle cx="500" cy="37.442684428598" r="6" fill="#21C55D" />,		<circle cx="625" cy="57.3469124308136" r="6" fill="#21C55D" />,		<circle cx="750" cy="153.63633110776513" r="6" fill="#21C55D" />,		<circle cx="875" cy="141.59317735358118" r="6" fill="#21C55D" />,		<circle cx="1000" cy="93.24129059294606" r="6" fill="#21C55D" />   </g> </svg>'
            ],
            [
                'title' => 'Users',
                'count' => User::where('status', 'activated')->count(),
                'direction' => 'up',
                'percent' => 2.3,
                'icon' => 'fas fa-users',
                'color' => 'bg-info',
                'progress' => '<svg class="w-full" viewBox="0 0 1000 200"   xmlns="http://www.w3.org/2000/svg" >      <path d="M 0,120.25725212587784 C 25,106.9920606379244 75,73.79427105562183 125,53.93129468611061 C 175,34.0683183165994 200,14.453247679331994 250,20.942370278321786 C 300,27.431492877311584 325,83.76678169992023 375,86.3769076810596 C 425,88.98703366219898 450,44.6771893474984 500,33.993000184018655 C 550,23.308811020538926 575,30.230963392367087 625,32.955961863660974 C 675,35.680960334954875 700,38.57409448165062 750,47.61799254048816 C 800,56.6618905993257 825,66.32850698611925 875,78.1754521578487 C 925,90.02239732957814 975,101.11726515087803 1000,106.85271839913536,L 1000 200,L 0 200Z" fill="#21c55d1a" />   <path d="M 0,120.25725212587784 C 25,106.9920606379244 75,73.79427105562183 125,53.93129468611061 C 175,34.0683183165994 200,14.453247679331994 250,20.942370278321786 C 300,27.431492877311584 325,83.76678169992023 375,86.3769076810596 C 425,88.98703366219898 450,44.6771893474984 500,33.993000184018655 C 550,23.308811020538926 575,30.230963392367087 625,32.955961863660974 C 675,35.680960334954875 700,38.57409448165062 750,47.61799254048816 C 800,56.6618905993257 825,66.32850698611925 875,78.1754521578487 C 925,90.02239732957814 975,101.11726515087803 1000,106.85271839913536" fill="none" stroke="#21C55D" stroke-width="1px" />   <g>   		<circle cx="0" cy="120.25725212587784" r="6" fill="#21C55D" />,		<circle cx="125" cy="53.93129468611061" r="6" fill="#21C55D" />,		<circle cx="250" cy="20.942370278321786" r="6" fill="#21C55D" />,		<circle cx="375" cy="86.3769076810596" r="6" fill="#21C55D" />,		<circle cx="500" cy="33.993000184018655" r="6" fill="#21C55D" />,		<circle cx="625" cy="32.955961863660974" r="6" fill="#21C55D" />,		<circle cx="750" cy="47.61799254048816" r="6" fill="#21C55D" />,		<circle cx="875" cy="78.1754521578487" r="6" fill="#21C55D" />,		<circle cx="1000" cy="106.85271839913536" r="6" fill="#21C55D" />   </g> </svg>'
            ],
            'title' => 'Faththinks',
                'count' => Faththink::count(),
                'direction' => 'up',
                'percent' => 1.5,
                'icon' => 'fas fa-user-plus',
                'color' => 'bg-success',
                'progress' => '<svg class="w-full" viewBox="0 0 1000 200"   xmlns="http://www.w3.org/2000/svg" >      <path d="M 0,133.86695711360943 C 25,118.32720364131744 75,66.52490216321823 125,56.16818975214948 C 175,45.811477341080746 200,72.4707573747341 250,82.08339505826574 C 300,91.69603274179737 325,105.16510573320471 375,104.23137816980763 C 425,103.29765060641056 450,77.09024792104188 500,77.4147572412804 C 550,77.73926656151893 575,98.83643154627106 625,105.85392477100028 C 675,112.8714179957295 700,127.47265377945222 750,112.50222336492648 C 800,97.53179295040076 825,21.638034012825432 875,31.00177269837167 C 925,40.36551138391791 975,133.65708797380046 1000,159.32091679265767,L 1000 200,L 0 200Z" fill="#21c55d1a" />   <path d="M 0,133.86695711360943 C 25,118.32720364131744 75,66.52490216321823 125,56.16818975214948 C 175,45.811477341080746 200,72.4707573747341 250,82.08339505826574 C 300,91.69603274179737 325,105.16510573320471 375,104.23137816980763 C 425,103.29765060641056 450,77.09024792104188 500,77.4147572412804 C 550,77.73926656151893 575,98.83643154627106 625,105.85392477100028 C 675,112.8714179957295 700,127.47265377945222 750,112.50222336492648 C 800,97.53179295040076 825,21.638034012825432 875,31.00177269837167 C 925,40.36551138391791 975,133.65708797380046 1000,159.32091679265767" fill="none" stroke="#21C55D" stroke-width="1px" />   <g>   		<circle cx="0" cy="133.86695711360943" r="6" fill="#21C55D" />,		<circle cx="125" cy="56.16818975214948" r="6" fill="#21C55D" />,		<circle cx="250" cy="82.08339505826574" r="6" fill="#21C55D" />,		<circle cx="375" cy="104.23137816980763" r="6" fill="#21C55D" />,		<circle cx="500" cy="77.4147572412804" r="6" fill="#21C55D" />,		<circle cx="625" cy="105.85392477100028" r="6" fill="#21C55D" />,		<circle cx="750" cy="112.50222336492648" r="6" fill="#21C55D" />,		<circle cx="875" cy="31.00177269837167" r="6" fill="#21C55D" />,		<circle cx="1000" cy="159.32091679265767" r="6" fill="#21C55D" />   </g> </svg>'
        ];
    }

    public function agenda()
    {
        return [
            [
                'title' => 'Lorem Ipsum',
                'date' => \Cal::dateTime(now()->addHour(1)),
                'icon' => 'fas fa-handshake',
                'color' => 'bg-danger',
            ],
            [
                'title' => 'Lorem Ipsum',
                'date' => \Cal::date(now()->addDay(1)),
                'icon' => 'fas fa-video',
                'color' => 'bg-success',
            ],
            [
                'title' => 'Lorem Ipsum',
                'date' => \Cal::date(now()->addDays(3)),
                'icon' => 'fas fa-calendar',
                'color' => 'bg-info',
            ],
            [
                'title' => 'Lorem Ipsum',
                'date' => \Cal::dateTime(now()->addDays(5)),
                'icon' => 'fas fa-video',
                'color' => 'bg-success',
            ],
            [
                'title' => 'Lorem Ipsum',
                'date' => CalHelper::showDate(now()->addDays(3)),
                'icon' => 'fas fa-headphones',
                'color' => 'bg-warning',
            ],
        ];
    }

    public function chart()
    {
        return [
            'labels' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
            'datasets' => [
                [
                    'label' => '# of User Registration',
                    'data' => [30, 40, 50, 25, 5],
                    'borderColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                    'backgroundColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                ],
                [
                    'label' => '# of Active Registration',
                    'data' => [63, 105, 75, 25, 35],
                    'borderColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                    'backgroundColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                ],
                [
                    'label' => '# of Inactive User',
                    'data' => [6, 8, 5, 3, 4],
                    'borderColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                    'backgroundColor' => ['#FF6384', '#37A2EB', '#4BC0C0'],
                ],
            ],
        ];
    }

    public function project()
    {
        return [
            'header' => [
                ['key' => 'select', 'label' => '', 'visibility' => true],
                ['key' => 'members', 'label' => 'Members', 'visibility' => true],
                ['key' => 'project', 'label' => 'Project', 'visibility' => true],
                ['key' => 'client', 'label' => 'Client', 'visibility' => true],
                ['key' => 'progress', 'label' => 'Progress', 'visibility' => true],
                ['key' => 'deadline', 'label' => 'Deadline', 'visibility' => true],
                ['key' => 'action', 'label' => '', 'visibility' => true],
            ],
            'data' => [
                [
                    'uuid' => (string) Str::uuid(),
                    'members' => [
                        ['name' => fake()->name(), 'path' => '/images/photos/user1.jpeg'],
                    ],
                    'project_color' => '#FF1900',
                    'project' => 'Logo Design',
                    'client' => 'Abu Bakar Ash-Shiddiq',
                    'color' => 'bg-warning',
                    'progress' => 53,
                    'deadline' => CalHelper::showDate(today()->addDay(rand(1, 20))->toDateString())
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'members' => [
                        ['name' => fake()->name(), 'path' => '/images/photos/user2.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user4.jpeg'],
                    ],
                    'project_color' => '#F47365',
                    'project' => 'Website Design',
                    'client' => 'Umar Bin Khaththab',
                    'color' => 'bg-danger',
                    'progress' => 10,
                    'deadline' => CalHelper::showDate(today()->addDay(rand(1, 20))->toDateString())
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'members' => [
                        ['name' => fake()->name(), 'path' => '/images/photos/user2.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user3.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user9.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user10.jpeg'],
                    ],
                    'project_color' => '#FFB243',
                    'project' => 'Mobile App Design',
                    'client' => 'Utsman Bin Affan',
                    'color' => 'bg-info',
                    'progress' => 70,
                    'deadline' => CalHelper::showDate(today()->addDay(rand(1, 20))->toDateString())
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'members' => [
                        ['name' => fake()->name(), 'path' => '/images/photos/user2.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user4.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user6.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user8.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user7.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user10.jpeg'],
                    ],
                    'project_color' => '#FFE623',
                    'project' => 'CRM Design',
                    'client' => 'Ali Bin Abi Thalib',
                    'color' => 'bg-success',
                    'progress' => 95,
                    'deadline' => CalHelper::showDate(today()->addDay(rand(1, 20))->toDateString())
                ],
                [
                    'uuid' => (string) Str::uuid(),
                    'members' => [
                        ['name' => fake()->name(), 'path' => '/images/photos/user1.jpeg'],
                        ['name' => fake()->name(), 'path' => '/images/photos/user3.jpeg'],
                    ],
                    'project_color' => '#6EFF2A',
                    'project' => 'SEO',
                    'client' => 'Salman Al Farisi',
                    'color' => 'bg-success',
                    'progress' => 85,
                    'deadline' => CalHelper::showDate(today()->addDay(rand(1, 20))->toDateString())
                ],
            ]
        ];
    }
}
