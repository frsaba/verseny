<script setup>
import Layout from "../Shared/Layout.vue";
import UsersTable from "../Shared/UsersTable.vue";

defineProps({
	users: Array
})
</script>

<template>
	<layout>
		<users-table :users="users">
			<template v-slot:no_data>
				<span class="font-italic">
					Nincs megjeleníthető felhasználó
				</span>
			</template>
		</users-table>
	</layout>
</template>