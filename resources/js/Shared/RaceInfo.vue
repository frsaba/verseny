<script setup>
import axios from 'axios';
import UsersTable from '../Shared/UsersTable.vue'

const props = defineProps({
	id: Number,
	name: String,
	year: Number,
	rounds: Array
});

const emit = defineEmits(['new-round', 'add-contestant', 'delete-user'])

function newRound() {
	axios.post(`/races/${props.id}/rounds`, {});
	emit('new-round');
}
</script>

<template>
	<v-card class="pa-3 px-md-6">
		<div class="d-flex align-center justify-space-between flex-wrap pb-4 race-name">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag</v-icon>
				{{ name }}
			</div>
			{{ year }}
		</div>
		<div class="rounds pl-2">
			<div v-for="round, n in rounds" :key="round.id">
				<div class="py-2 d-flex flex-wrap align-center justify-space-between">
					<span class="text-overline">{{ n + 1 }}.forduló
						{{ round.contestants && round.contestants.length > 0 ? "versenyzői:" : "" }}</span>
					<v-btn color="success" size="small" variant="outlined"
						@click="this.$emit('add-contestant', { raceID: id, round })">
						<v-icon start>mdi-account-plus</v-icon>
						Versenyző felvétele
					</v-btn>
				</div>
				<users-table :users="round.contestants" :compact="true" show-delete-button
					@delete-user="(userID) => this.$emit('delete-user', round.id, userID)"></users-table>
				<hr width="90%" class="mx-auto	">
			</div>
			<v-btn color="primary" @click="newRound" class="my-3"><v-icon>mdi-plus</v-icon> Új forduló</v-btn>
		</div>

	</v-card>
</template>

<style scoped>
.race-name {
	font-weight: bold;
	font-size: 24px;
}
</style>