<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
	<v-app>
		<v-app-bar prominent class="px-6 bg-primary">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag-checkered</v-icon>
				<h1>TrackMaster</h1>
			</div>
			<v-spacer></v-spacer>
			<nav>
				<Link href="/" :class="{ disabled: $page.url == '/' }">
					Versenyek
				</Link>
				<Link href="/users" :class="{ disabled: $page.url.startsWith('/users') }">
					Felhasználók
				</Link>
			</nav>
		</v-app-bar>
		<section>
			<div class="main mx-auto px-2">
				<div class="header">
					<slot name="header"/>
				</div>
				<slot />
			</div>
		</section>
	</v-app>
</template>

<style>
.main {
	max-width: 800px;
	margin-top: 80px;
}

.header {
	top: 80px;
	z-index: 100;
	position: sticky;
	background:white;
}

nav {
	display: flex;
	gap: 0.2em;
}

a:visited {
	color: white;
}

a {
	color: white;
}

a.disabled {
	color: lightgray;
}

.v-toolbar__content {
	flex-wrap: wrap;
	gap: 0.2em;
	height: 5em !important;
}
</style>