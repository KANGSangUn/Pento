<!--
dev . KANG SANG UN
-->
<template>
    <div class="footer_div">
        <div>
            <ul>
                <li v-for="name in team_member">
                    {{name}}
                </li>
            </ul>
        </div>
        <div>

        </div>
        <div>
            Project Pento dev.Kang
        </div>
        <div>
            Project Pento dev.Kang111
        </div>
    </div>
</template>
<script>
    export default{

        data(){
            return {
                team_member :['정현우','최요한','강상운','김영문','성경임','정지민']
            }
        }
   }

</script>
<style>
    .footer_div{
        padding: 1vw;
        text-align: center;
        background-color: #2b2b2b;
        width: 100%;
        height: 300px;
        color : white;
        display : grid;
        grid-template-columns : 1fr 1fr 1fr 1fr;
    }

</style>