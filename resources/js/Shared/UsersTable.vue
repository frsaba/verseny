<script setup>
defineProps({
	users: Array
})
</script>

<template>
	<v-table v-if="users">
		<thead>
			<tr>
				<th class="text-left">
					Név
				</th>
				<th class="text-left">
					Email
				</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="item in users" :key="item.name">
				<td>{{ item.name }}</td>
				<td>{{ item.email }}</td>
			</tr>
		</tbody>
	</v-table>
	<slot name="no_data" v-else>
		
	</slot>
</template>