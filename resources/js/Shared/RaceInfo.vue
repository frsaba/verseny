<script setup>
import axios from 'axios';
import UsersTable from '../Shared/UsersTable.vue'

const props = defineProps({
	id: Number,
	name: String,
	year: Number,
	rounds: Array
});

const emit = defineEmits(['new-round'])

function newRound(){
	axios.post(`/races/${props.id}/rounds`, {});
	emit('new-round');
}
</script>

<template>
	<v-card class="pa-2 px-md-6">
		<div class="d-flex align-center justify-space-between flex-wrap">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag</v-icon>
				<span class="race-name">
					{{name}}
				</span>
			</div>
			{{year}}
		</div>
		<div class="rounds">
			<div class="px-5" v-for="round, n in rounds" :key="round.id">
				<span class="text-overline">{{n+1}}.forduló {{ round.contestants && round.contestants.length > 0 ? "versenyzői:" : "" }}</span>
				<users-table :users="round.contestants"></users-table>
				<hr width="90%" class="mx-auto mb-5">
			</div>
			<v-btn color="primary" @click="newRound"><v-icon>mdi-plus</v-icon> Új forduló</v-btn>
		</div>

	</v-card>
</template>

<style scoped>
.race-name{
	font-weight: bold;
	font-size: 24px;
}
</style>