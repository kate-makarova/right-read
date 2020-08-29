<template>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <router-link class="navbar-brand" to="/"><img :src="'/image/easy-read.png'" alt="image" style="width: 65px" /></router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li><router-link to="/" class="nav-item nav-link">Home</router-link></li>
                    <li><router-link to="/about" class="nav-item nav-link">About</router-link></li>
                </ul>
            </div>

            <div class="collapse navbar-collapse flex-grow-1">
                <h1>Español</h1>
            </div>

            <div class="collapse navbar-collapse flex-grow-0">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <router-link :to="{ name: 'login' }">Login</router-link>
                        <router-link :to="{ name: 'register' }">Register</router-link>
                        <a class="dropdown-item" href="#">Laguages</a>
                        <a class="dropdown-item" href="#">Bookmarks</a>
                        <a class="dropdown-item" href="#">History</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
                    </div>
                </li>
                </ul>
            </div>
        </nav>

        <div id="content-container" class="container">
        <router-view></router-view>
        </div>


        <footer class="bd-footer text-muted">
            <div class="container-fluid p-3 p-md-5">
                <ul class="bd-footer-links">
                    <li><router-link to="/about">About</router-link></li>
                    <li><a href="https://github.com/kate-makarova/text-match">GitHub</a></li>
                </ul>
                <p>(c) 2020</p>
            </div>
        </footer>
    </div>
</template>

<script>
export default {}
</script>
