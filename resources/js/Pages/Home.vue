<script>
import Layout from "../Shared/Layout.vue";
import RaceInfo from "../Shared/RaceInfo.vue";
import axios from "axios";

export default {
	layout: Layout,
	components: { RaceInfo },
	methods: {
		async getRaces() {
			const response = await axios.get('/races');
			this.races = response.data;
		},
		async createRace(name, year) {
			await axios.post('/races', {name,year});
			this.newRaceDialog = false;
			this.getRaces();
		}
	},
	mounted() {
		this.getRaces();
	},
	data: () => ({
		name: "",
		year: 2023,
		races: [],
		newRaceDialog: false,
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
	<div>

		<div class="d-flex justify-space-between flex-wrap">
			<h2 class="text-overline">Versenyek</h2>
			<v-dialog width="500" v-model="newRaceDialog">
				<template v-slot:activator="{ props }">
					<v-btn color="success" v-bind="props"> <v-icon start>mdi-plus</v-icon> Új verseny felvétele </v-btn>
				</template>

				<template v-slot:default>
					<v-card class="pa-5" title="Új verseny felvétele">
						<v-form @submit.prevent="createRace(name, year)" class="mt-5">
							<v-text-field
								v-model="name"
								:rules="nameRules"
								required
								label="Név"></v-text-field>
							<v-text-field
								v-model.number="year"
								:rules="yearRules"
								required
								label="Év"></v-text-field>

						<v-btn type="submit" color="success" block outline class="mt-2">
							Új verseny</v-btn>
						</v-form>

					</v-card>
				</template>
			</v-dialog>

		</div>
		<section class="races mt-5">
			<race-info v-for="race of races" :key="race.id" v-bind="race"></race-info>
		</section>
	</div>
</template>

<style scoped>
.races {
	display: flex;
	flex-direction: column;
	gap: 1em;
}
</style>
