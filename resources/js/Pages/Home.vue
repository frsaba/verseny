<script>
import Layout from "../Shared/Layout.vue";
import RaceInfo from "../Shared/RaceInfo.vue";
import axios from "axios";

export default {
	components: { RaceInfo, Layout },
	props: {
		users: Array
	},
	methods: {
		async getRaces() {
			const response = await axios.get('/races');
			this.races = response.data;
		},
		async createRace(name, year) {
			name = name.trim();

			//if race already exists, show an error
			if (this.races.some(r => r.name == name && r.year == year)) {
				this.errors.push("Ez a verseny már létezik!")
				return;
			}

			await this.$inertia.post('/races', { name, year });
			this.newRaceDialog = false;
			this.errors = []
			this.getRaces();
		},
		openAddContestantDialog({ raceID, round }) {
			this.selectedRound = round;
			this.addToRoundDialog = true;
		},
		async addToRound(round, contestants) {
			for (const user of contestants) {
				await this.$inertia.post(`/rounds/${round.id}/contestants`, { user_id: user });			
			}
			this.addToRoundDialog = false;
			this.selectedContestants = null;
			this.getRaces();
		},
		async removeUser(roundID, user) {
			await this.$inertia.delete(`/rounds/${roundID}/contestants/${user}`);
			this.getRaces();
		}
	},
	computed:
	{
		filteredUsers() {
			if (this.selectedRound == null) return this.users;
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
		selectedContestants: null,
		selectedRound: null,
		errors: [],
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
		<template v-slot:header>
			<div class="pa-2 d-flex justify-space-between flex-wrap border">

				<h2>Versenyek</h2>
				<v-dialog width="500" v-model="newRaceDialog">
					<template v-slot:activator="{ props }">
						<v-btn color="success" v-bind="props"> <v-icon start>mdi-plus</v-icon> Új verseny felvétele </v-btn>
					</template>

					<template v-slot:default>
						<v-card class="pa-5" title="Új verseny felvétele">
							<v-form @submit.prevent="createRace(newRaceName, newRaceYear)" class="mt-5">
								<div class="errors text-center mb-2">
									<span color="error" v-for="error, n of errors" :key="n">{{ error }}</span>
								</div>
								<v-text-field v-model="newRaceName" :rules="nameRules" required label="Név"
									@input="errors = []"></v-text-field>
								<v-text-field v-model.number="newRaceYear" :rules="yearRules" required @input="errors = []"
									label="Év"></v-text-field>

								<v-btn type="submit" :disabled="errors.length > 0 && selectedContestants.length == 0" color="success" block outline
									class="mt-2">
									Új verseny</v-btn>
							</v-form>

						</v-card>
					</template>
				</v-dialog>

				<v-dialog width="500" v-model="addToRoundDialog">
					<v-card class="pa-5" title="Versenyző felvétele">
						<v-form @submit.prevent="addToRound(selectedRound, selectedContestants)" class="mt-5">
							<v-autocomplete v-model="selectedContestants" multiple :items="filteredUsers" item-title="name"
								item-value="id" label="Válassz versenyzőt..."> </v-autocomplete>
							<v-btn type="submit" :disabled="selectedContestants == null" color="success" block outline
								class="mt-2">
								Felvétel</v-btn>
						</v-form>

					</v-card>
				</v-dialog>

			</div>
		</template>
		<section class="races mt-5">
			<race-info v-for="race of races" :key="race.id" v-bind="race" @new-round="getRaces"
				@add-contestant="openAddContestantDialog" @delete-user="removeUser"></race-info>
		</section>
	</layout>
</template>

<style scoped>
.races {
	display: flex;
	flex-direction: column;
	gap: 1em;
}

.errors {
	font-style: italic;
	color: red;
	height: 1.2em;
}
.border{
	border-bottom: 1px solid grey;
}
</style>
