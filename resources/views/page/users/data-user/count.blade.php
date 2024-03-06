<div class="flex flex-col items-center">
    <h1 class="font-semibold text-sm">{{ $countPost }}</h1>
    <h1 class="text-xs">Postingan</h1>
</div>
<a class="flex flex-col items-center" href="/followers/show={{ $user->uuid }}">
    <h1 class="font-semibold text-sm">{{ $user->followers->count() }}</h1>
    <h1 class="text-xs">Pengikut</h1>
</a>
<a class="flex flex-col items-center" href="/following/show={{ $user->uuid }}">
    <h1 class="font-semibold text-sm">{{ $user->following->count() }}</h1>
    <h1 class="text-xs">Mengikuti</h1>
</a>
