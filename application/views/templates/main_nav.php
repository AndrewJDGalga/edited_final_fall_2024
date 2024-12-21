<header>
    <h1 class="logo-font margin-bottom-halfch text-horizontal-center margin-zero">
        <a href="/home">NewsGems</a>
    </h1>
    <button id="btn_mobile" class="margin-horizontal-auto" aria-expanded="false" aria-controls="nav_mobile"><span>&#8801;</span></button>
    <nav id="nav_mobile" class="mobile-invisible">
        <ul class="margin-zero">
            {nav_button}
                <li><a href={location} class={class}>{name}</a></li>
            {/nav_button}
        </ul>
    </nav>
</header>