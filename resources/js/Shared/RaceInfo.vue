<script setup>
const props = defineProps({
	name: String,
	year: Number,
	rounds: Array
})
</script>

<template>
	<v-card class="pa-10">
		<div class="d-flex align-center justify-space-between flex-wrap">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag</v-icon>
				<span class="race-name">
					{{name}}
				</span>
			</div>
			{{year}}
		</div>
		<div v-for="round, n in rounds" :key="round.id">
			{{n+1}}.forduló {{round.time}}
		</div>
	</v-card>
</template>

<style scoped>
.race-name{
	font-weight: bold;
	font-size: 24px;
}
</style>