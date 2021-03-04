<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead"> ข้อมูลทั่วไป </v-card-title>
      </v-card>
    </v-flex>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead">
          ประวัติเสี่ยง
        </v-card-title>
      </v-card>
    </v-flex>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead">
          อาการและอาการแสดง
        </v-card-title>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  components: {},
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
</style>
