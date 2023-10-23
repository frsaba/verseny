<script>
import Layout from "../Shared/Layout.vue";
import RaceInfo from "../Shared/RaceInfo.vue";
import axios from "axios";

export default {
	components: { RaceInfo, Layout },
	props:{
		users: Array
	},
	methods: {
		async getRaces() {
			const response = await axios.get('/races');
			this.races = response.data;
		},
		async createRace(name, year) {
			await this.$inertia.post('/races', { name, year });
			this.newRaceDialog = false;
			this.getRaces();
		},
		openAddContestantDialog({ raceID, round }) {
			this.selectedRound = round;
			this.addToRoundDialog = true;
		},
		async addToRound( round, user) {
			await this.$inertia.post(`/rounds/${round.id}/contestants`, { user_id: user });
			this.getRaces();
			this.addToRoundDialog = false;
			this.selectedContestant = null;
		}
	},
	computed:
	{
		filteredUsers(){
			if(this.selectedRound == null) return this.users;
			//filter out contestants that are already assigned to this round
			return this.users.filter(u => this.selectedRound.contestants.some(other => u.id == other.id) == false)
		}
	},
	mounted() {
		this.getRaces();
	},
	data: () => ({
		newRaceName: "",
		newRaceYear: 2023,
		races: [],
		newRaceDialog: false,
		addToRoundDialog: false,
		selectedContestant: "",
		selectedRound: null,
		roundID: -1,
		nameRules: [
			value => {
				if (value) return true
				return 'A nevet meg kell adni!'
			},
		],
		yearRules: [
			value => {
				if (value) return true
				return 'Az évet meg kell adni!'
			},
		],
	})
}
</script>

<template>
	<layout>

		<div class="d-flex justify-space-between flex-wrap">

			<h2 class="text-overline">Versenyek</h2>
			<v-dialog width="500" v-model="newRaceDialog">
				<template v-slot:activator="{ props }">
					<v-btn color="success" v-bind="props"> <v-icon start>mdi-plus</v-icon> Új verseny felvétele </v-btn>
				</template>

				<template v-slot:default>
					<v-card class="pa-5" title="Új verseny felvétele">
						<v-form @submit.prevent="createRace(newRaceName, newRaceYear)" class="mt-5">
							<v-text-field v-model="newRaceName" :rules="nameRules" required label="Név"></v-text-field>
							<v-text-field v-model.number="newRaceYear" :rules="yearRules" required
								label="Év"></v-text-field>

							<v-btn type="submit" color="success" block outline class="mt-2">
								Új verseny</v-btn>
						</v-form>

					</v-card>
				</template>
			</v-dialog>

			<v-dialog width="500" v-model="addToRoundDialog">
				<v-card class="pa-5" title="Versenyző felvétele">
					<v-form @submit.prevent="addToRound(selectedRound, selectedContestant)" class="mt-5">
						<v-autocomplete v-model="selectedContestant" :items="filteredUsers" item-title="name" item-value="id" label="Válassz versenyzőt..."> </v-autocomplete>
						<v-btn type="submit" :disabled="selectedContestant == null" color="success" block outline class="mt-2">
								Felvétel</v-btn>
					</v-form>

				</v-card>
			</v-dialog>

		</div>
		<section class="races mt-5">
			<race-info v-for="race of races" :key="race.id" v-bind="race" @new-round="getRaces"
				@add-contestant="openAddContestantDialog"></race-info>
		</section>
	</layout>
</template>

<style scoped>
.races {
	display: flex;
	flex-direction: column;
	gap: 1em;
}
</style>
