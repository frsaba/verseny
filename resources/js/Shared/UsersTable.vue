<script setup>
defineProps({
	users: Array,
	compact: Boolean,
	showDeleteButton: Boolean,
})
defineEmits(['delete-user'])
</script>

<template>
	<v-table class="mb-3" :density="compact ? 'compact' : 'comfortable'" v-if="users && users.length > 0">
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
				<td width="1em" v-if="showDeleteButton">
					<v-btn @click="this.$emit('delete-user', item.id)" size="x-small" variant="outlined" color="error" icon="mdi-trash-can-outline"></v-btn>
				</td>
			</tr>
		</tbody>
	</v-table>
	<slot name="no_data" v-else>
		
	</slot>
</template>