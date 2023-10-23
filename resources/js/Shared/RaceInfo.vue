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
	<v-card class="pa-2 px-md-6">
		<div class="d-flex align-center justify-space-between flex-wrap">
			<div class="d-flex align-center">
				<v-icon start>mdi-flag</v-icon>
				<span class="race-name">
					{{ name }}
				</span>
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
				<users-table :users="round.contestants" :compact="true" @delete-user="(userID) => this.$emit('delete-user', round.id, userID)"></users-table>
				<hr width="90%" class="mx-auto my-5">
			</div>
			<v-btn color="primary" @click="newRound"><v-icon>mdi-plus</v-icon> Új forduló</v-btn>
		</div>

	</v-card>
</template>

<style scoped>
.race-name {
	font-weight: bold;
	font-size: 24px;
}
</style>