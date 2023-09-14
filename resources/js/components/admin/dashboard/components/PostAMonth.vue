<template>
    <div class="stat_post_month">
        <div class="stat_date_picker">
            <span>Chọn tháng</span>
            <a-month-picker
            placeholder="YYYY-MM"
            size="large"
            v-model="monthSelect"
            @change="onChange"
            :disabled-date="disabledDate"
            :class="'month-picker__input'"
          ></a-month-picker>
        </div>
       
    </div>
     
</template>

<script>
import moment from 'moment';
export default {
    data(){
        return {
            monthSelect: moment().format("YYYY-MM"),   
        }
    },
    methods:{
        onChange(){
            console.log(this.monthSelect);
        }
    },
}
</script>

<style lang="scss">
    .stat_post_month{
        .stat_date_picker
        {
            width: 156px;
    
    padding: 40px 0 0 40px;
        }
    }
.month-picker__input {
    border-radius: 10px;
    font-size: 14px;
  .ant-calendar-picker-input {
    border-radius: 10px;
    font-size: 14px;

    .ant-calendar-picker-input {
      margin-top: -8px;
    }
  }
}
</style>