<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-allergy</v-icon
          >&nbsp;สัมผัสผู้ติดเชื้อ
        </v-card-title>

        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">ข้อมูลทั่วไป</h3>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text"">ประวัติเสี่ยง</h3>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text"">อาการและอาการแสดง</h3>
            </v-alert>
          </v-card>
        </v-flex>
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
