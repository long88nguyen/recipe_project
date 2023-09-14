<template>
  <table class="content-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Points</th>
                <th>Team</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Domenic</td>
                <td>88,110</td>
                <td>dcode</td>
            </tr>
        </tbody>
  </table>
 
</template>

<script>
export default {

}
</script>

<style lang="scss">
.content-table{
  border-collapse: collapse;
  margin: 25px 0;
  font-size: 15px;
  min-width: 90%; 
  border-radius: 5px 5px 0 0 ;
  overflow: hidden;
  box-shadow: 0 0 20px rgba(0,0,0,0.15);
  thead{
    tr{
        background-color: #009879;
        color:#ffffff;
        text-align: left;
        font-weight: bold;
        th{
            padding:12px 15px
        }
    }
  } 
  tbody{
    tr{
        border-bottom : 1px solid #dddddd;
        td{
            padding:12px 15px;
        }
    }
    tr:nth-of-type(even)
    {
        background-color: #f3f3f3;
    }
    tr:last-of-type
    {
        border-bottom: 2px solid #009879;
    }
  }
}

</style>