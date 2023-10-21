<script>

</script>

<template>
	<section class="pa-5 header">
		<v-icon size="1.5em" color="black">mdi-flag-checkered</v-icon>
		<h1>TrackMaster</h1>
	</section>

	<section class="pa-6">
		<div class="main mx-auto">
			<slot />
		</div>
	</section>
</template>

<style scoped>
.main{
	max-width: 800px;
}

.header{
	display: flex;
	gap: 0.2em;
	background: rgb(163,188,221);
	background: radial-gradient(circle, rgba(163,188,221,1) 19%, rgba(150,185,249,1) 53%, rgba(111,137,191,1) 100%);
}
</style>