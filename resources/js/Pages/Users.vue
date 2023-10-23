<script setup>
import Layout from "../Shared/Layout.vue";
import UsersTable from "../Shared/UsersTable.vue";
import { ref } from "vue";

defineProps({
	users: Array
})
let name = ref("");
let email = ref("");

let nameRules = [
	value => {
		if (value) return true
		return 'A nevet meg kell adni!'
	},
];
let emailRules = [
	value => {
		if (value) return true
		return 'Az email címet meg kell adni!'
	},
];
</script>

<script>
export default {
	data: () => ({
		newUserDialog : false
	}),
	methods: {
		async createUser(name, email) {
			this.$inertia.post('/users', { name, email })
			this.newUserDialog = false
		}
	},
}
</script>

<template>
	<layout>
		<v-dialog width="500" v-model="newUserDialog">
			<template v-slot:activator="{ props }">
				<v-btn v-bind="props" color="success"><v-icon start>mdi-account-plus</v-icon> Új felhasználó</v-btn>
			</template>

			<template v-slot:default="{ isActive }">
				<v-card title="Új felhasználó felvétele" class="pa-3">
					<v-form @submit.prevent="createUser(name, email)" class="mt-5">
						<v-text-field v-model="name" :rules="nameRules" required label="Név"></v-text-field>
						<v-text-field v-model="email" :rules="emailRules" required label="Email"></v-text-field>

						<v-btn type="submit" color="success" block outline class="mt-2">
							Létrehozás</v-btn>
					</v-form>
				</v-card>
			</template>
		</v-dialog>

		<users-table :users="users">
			<template v-slot:no_data>
				<span class="font-italic">
					Nincs megjeleníthető felhasználó
				</span>
			</template>
		</users-table>
	</layout>
</template>