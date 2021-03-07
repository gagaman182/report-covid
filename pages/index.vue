<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          รายงานพบผู้ติดเชื้อ
        </v-card-title>

        <v-alert
          v-for="item in ancovid"
          :key="item.num"
          text
          dense
          color="#ff005c"
          icon="mdi-clock-fast"
          border="left"
          >ลำดับที่ : {{ item.num }}
          <v-row>
            <v-col cols="12" class="text-center"> </v-col>
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                วันที่ : {{ item.date }}
              </v-card-text>
            </v-col>
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                AN : {{ item.an }}
              </v-card-text></v-col
            >
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                หอผู้ป่วย : {{ item.ward }}
              </v-card-text>
            </v-col>
          </v-row>
        </v-alert>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  components: {},
  data: () => ({
    ancovid: [
      { num: '1', date: '12-01-2564', an: '1/49', ward: 'อายุรกรรมหญิง 230' },
      { num: '2', date: '06-03-2564', an: '2/68', ward: 'อายุรกรรมชาย 210' },
    ],
  }),
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
</style>
