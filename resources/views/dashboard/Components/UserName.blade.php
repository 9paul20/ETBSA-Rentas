<div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
    <div class="flex items-center md:ml-auto md:pr-4">
    </div>
    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
        <li class="flex items-center">
            <a href=""
                class="block px-0 py-2 font-semibold transition-all ease-nav-brand text-size-sm text-slate-500">
                <i class="fa fa-user sm:mr-1" aria-hidden="true"></i>
                <span class="">{{ Auth::user()->name }}</span>
            </a>
        </li>
    </ul>
</div>
