<template>
  <div class="wrapper">
    <div class="header">
   
    </div>
    <v-chart  style="min-height: 280px, max-height: 500px" :option="option" autoresize />
  </div>
  </template>
  
  <script >
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { PieChart } from "echarts/charts";
import { TimelineComponent } from 'echarts/components';
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
} from "echarts/components";
import VChart from "vue-echarts";
use([
  CanvasRenderer,
  PieChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  TimelineComponent
]);
  
export default {
  name: "Chart",
  components: {
    VChart,
  },
  data() {
    return {
      option: {
        baseOption: {
          tooltip: {
            trigger: "item",
          },
          legend: {
            orient: "vertical",
            itemHeight: 25,
            itemWidth: 25,
            textStyle: {
              fontFamily: "Arial",
              fontSize: 14,
              height: 10,
              width: 100,
            },
            align: "left",
            selectedMode: false,
          },
          series: [
            {
              type: "pie",
              radius: ["40%", "90%"],
              center: ["30%", "50%"],
              avoidLabelOverlap: false,
              label: {
                show: true,
                position: "inside",
                formatter: "{c}",
                color: "#ffffff",
                fontWeight: "bold",
                fontSize: 14,
              },
              data: [
                { value: 335, name: 'Direct' },
                { value: 310, name: 'Email' },
                { value: 234, name: 'Ad Networks' },
                { value: 100, name: 'Video' },
                { value: 1548, name: 'Search Engines' },
              ],
            },
          ],
        },
        media: [
          {
            option: {
              legend: {
                right: "center",
                top: "0%",
                orient: "vertical",
                 itemHeight: 25,
                itemWidth: 25,
              },
              series: [
                {
                  radius: ["40%", "90%"],
                  center: ["30%", "50%"],
                },
                {
                  radius: ["40%", "90%"],
                  center: ["30%", "50%"],
                },
              ],
            },
          },
          {
            query: {
              minAspectRatio: 1,
            },
            option: {
              legend: {
                right: "10%",
                top: "15%",
                bottom: "0%",
                orient: "vertical",
                itemHeight: 25,
                itemWidth: 25,
              },
              series: [
                {
                  radius: ["30%", "60%"],
                  center: ["30%", "40%"],
                },
              ],
            },
          },
          {
            query: {
              maxAspectRatio: 1,
            },
            option: {
              legend: {
                right: "center",
                bottom: "0%",
                orient: "horizontal",
                itemHeight: 25,
                itemWidth: 25,
              },

              series: [
                {
                  radius: ["40%", "90%"],
                  center: ["10%", "50%"],
                },
                {
                  radius: ["40%", "90%"],
                  center: ["10%", "50%"],
                },
              ],
            },
          },
          {
            query: {
              maxWidth: 430,
            },
            option: {
              legend: {
                bottom: "13%",
                width: "100%",
                left: "0%",
                orient: "vertical",
                itemHeight: 20,
                itemWidth: 20,
              },

              series: [
                {
                  radius: ["25%", "52%"],
                  center: ["50%", "27%"],
                },
                {
                  radius: ["40%", "50%"],
                  center: ["50%", "50%"],
                },
              ],
            },
          },
        ],
      },
    };
  },
}
</script>
  

<style lang="scss" scoped>
.wrapper {
  position: relative;
  background: #ffffff;
  border: 1px solid #efefef;
  border-radius: 10px;
  padding: 30px 20px;
  height: 420px;
  .header {
    font-family: "-apple-system,BlinkMacSystemFont," Segoe UI ",Roboto,"
      Helvetica Neue ",Arial," Noto Sans ",sans-serif," Apple Color Emoji ","
      Segoe UI Emoji "," Segoe UI Symbol "," Noto Color Emoji "";
    font-size: 18px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
  }
}
</style>