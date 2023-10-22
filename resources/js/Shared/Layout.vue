<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
	<v-app>
		<v-app-bar class="px-6 header bg-primary">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag-checkered</v-icon>
				<h1>TrackMaster</h1>
			</div>
			<v-spacer></v-spacer>
			<nav>
				<Link href="/" :style="{disabled : true}">Versenyek</Link>
				<Link href="/users">Felhasználók</Link>
			</nav>
		</v-app-bar>
		<section class="pa-2">
			<div class="main mx-auto">
				<slot />
			</div>
		</section>
	</v-app>
</template>

<style scoped>
.main {
	max-width: 800px;
	margin-top: 5em;
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

a.disabled{
	color: gray;
}

.header {
	display: flex;
	gap: 0.2em;
}
</style>