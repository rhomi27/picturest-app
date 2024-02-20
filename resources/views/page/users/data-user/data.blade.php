<div class="w-full h-full bg-gray-100 mt-4 p-1 drop-shadow-md px-5 sticky start-0 top-9 z-10">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap justify-center -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-1 border-b-2 rounded-t-lg" id="profile-tab"
                    data-tabs-target="#postingan" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Postingan</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="inline-block p-1 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#albumid" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Album</button>
            </li>
        </ul>
    </div>
</div>
<div class="container mt-3 mx-auto">
    <div id="tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="postingan" role="tabpanel"
            aria-labelledby="profile-tab">
            <div id="data-wrap"
                class="columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-6 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">
            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="albumid" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <div id="album" class="grid grid-cols-1 sm:grid-cols-2 w-full h-full gap-2">
                
            </div>
        </div>
    </div>
</div>