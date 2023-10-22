<script>

</script>

<template>
		<section class="pa-5 header bg-primary">
			<v-icon size="1.5em">mdi-flag-checkered</v-icon>
			<h1>TrackMaster</h1>
		</section>
		<section class="pa-2">
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
	position: sticky;
	top: 0;
	display: flex;
	gap: 0.2em;
	z-index: 100;
}
</style>