<script>
import Layout from "../Shared/Layout.vue";

export default {
	layout: Layout,
	data: () => ({
		name: "",
		year: 2023,
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
	<div class="wrapper flex justify-space-between flex-wrap">

		<h2 class="text-overline">Versenyek</h2>
		<v-dialog width="500">
			<template v-slot:activator="{ props }">
				<v-btn color="success" v-bind="props"> <v-icon left>mdi-plus</v-icon> Új verseny felvétele </v-btn>
			</template>

			<template v-slot:default>
				<v-card class="pa-5" title="Új verseny felvétele">
					<v-form @submit.prevent>
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

					</v-form>

					<v-btn type="submit" color="success" block outline class="mt-2">
						Új verseny</v-btn>
				</v-card>
			</template>
		</v-dialog>
	</div>
</template>

<style scoped>
.wrapper {
	display: flex;
	gap: 1em;
}
</style>
