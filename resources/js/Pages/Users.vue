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
		newUserDialog: false,
		errors: []
	}),
	methods: {
		async createUser(name, email) {
			if (this.users.some(u => u.name == name && u.email == email)) {
				this.errors.push("Ez a felhasználó már létezik!")
				return;
			}

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
						<div class="errors text-center mb-2">
							<span color="error" v-for="error, n of errors" :key="n">{{ error }}</span>
						</div>

						<v-text-field v-model="name" :rules="nameRules" required label="Név" @change="errors=[]"></v-text-field>
						<v-text-field v-model="email" :rules="emailRules" required label="Email" @change="errors=[]"></v-text-field>

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

<style scoped>
.errors{
	font-style: italic;
	color: red;
	height: 1.2em;
}
</style>