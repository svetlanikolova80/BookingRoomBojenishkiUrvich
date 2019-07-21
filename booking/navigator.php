<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Навигация</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav navbar-left">
        <li><a  href="#">Избрани стаи</a></li>
        <li><a href="#">Детайли за резрвация</a></li>
        <li><a  href="#">Плащане</a></li>
    </ul>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php $created =  strftime("%Y-%m-%d %H:%M:%S", time()); echo date_toText($created); ?></a></li>
            <li class="dropdown">
            </li>
        </ul>
    </div>
</nav>