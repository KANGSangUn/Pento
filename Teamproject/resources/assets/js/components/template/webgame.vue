<template>
    <div class="web-game-main-layout">
      <div>
        <!-- <div class="board" v-for="frd_id_number_1 in board_id_1">
          <div class="board-child" v-for="frd_id_number_2 in board_id_2" v-bind:id="frd_id_number_1+','+frd_id_number_2"
          @mouseover="mouseOver(frd_id_number_1+frd_id_number_2)" 
          @drop="drop($event,frd_id_number_1,frd_id_number_2)" @dragover="allowDrop">
          </div>
        </div>  -->
        <div class="board" v-for="(board_row , key) in board_temp">
            <div  class="board-child" 
                  v-for="(board_columns,columnskey) in board_row"
                  v-bind:id="key+','+columnskey"
                  @mouseover="mouseOver(key,columnskey)"
                  @drop="drop($event,key,columnskey)" @dragover="allowDrop">
            </div>
        </div>
      </div>
      <div class="block-box">
        <div v-for="(block,key) in blocks" class="block-layout" draggable="true">
            <div class="block-style" v-for="(block_row, key) in block">
              <div v-for="(block_column, key) in block_row">
                <div v-if="block_column===0" class="empty-block">
                   
                </div>
                <div v-else-if="block_column=='A'" class="full-block">

                </div>
              </div>
            </div>
        </div>

      </div>  
    </div>
</template>

<script>
export default {
  data() {
    return {
      point_temp: "",
      board_temp: {
        "0": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "1": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "2": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "3": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "4": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

        "5": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "6": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "7": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "8": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "9": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],

        "10": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "11": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "12": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "13": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        "14": [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
      },
      blocks: {
        pento_block_F: {
          "0": ["A", "A"],
          "1": ["A", "A"],
          "2": ["A"]
        },
        pento_block_I: {
          "0": ["A"],
          "1": ["A"],
          "2": ["A"],
          "3": ["A"],
          "4": ["A"]
        },
        pento_block_L: {
          "0": ["A"],
          "1": ["A"],
          "2": ["A"],
          "3": ["A", "A"]
        },
        pento_block_N: {
          "0": [0, "A"],
          "1": ["A", "A"],
          "2": ["A"],
          "3": ["A"]
        },
        pento_block_F: {
          "0": ["A", "A"],
          "1": ["A", "A"],
          "2": ["A"]
        },
        pento_block_T: {
          "0": ["A", "A", "A"],
          "1": [0, "A", 0],
          "2": [0, "A", 0]
        },
        pento_block_U: {
          "0": ["A", 0, "A"],
          "1": ["A", "A", "A"]
        },
        pento_block_V: {
          "0": ["A", 0, 0],
          "1": ["A", 0, 0],
          "2": ["A", "A", "A"]
        },
        pento_block_X: {
          "0": [0, "A", 0],
          "1": ["A", "A", "A"],
          "2": [0, "A", 0]
        },
        pento_block_Y: {
          "0": [0, "A"],
          "1": ["A", "A"],
          "2": [0, "A"],
          "3": [0, "A"],
          "4": [0, "A"]
        },
        pento_block_Z: {
          "0": ["A", "A", 0],
          "1": [0, "A", 0],
          "2": [0, "A", "A"]
        }
      }
    };
  },
  methods: {
    mouseOver: function(point_X, point_Y) {
      // console.log(item);
      this.point_temp = point_X + "," + point_Y;
    },
    allowDrop: function(ev) {
      ev.preventDefault();
    },
    drag: function(ev) {
      //드랙 잡기 소스코드
      ev.dataTransfer.setData("text", ev.target.id);
    },
    drop: function(ev, num1, num2) {
      ev.preventDefault();
      let data = ev.dataTransfer.getData("text");
      this.point_block_F(ev, num1, num2);
    },

    point_block_F: function(ev, num1, num2) {
      let iddd = num1 + "," + (num2 + 1);
      let block_sub = document.getElementById(iddd);
      ev.target.setAttribute("class", "full-block");
      block_sub.setAttribute("class", "full-block");
      ev.target.setAttribute("draggable", "true");
      block_sub.setAttribute("draggable", "true");
    }
  }
};
</script>
<style scoped>
.web-game-main-layout {
  display: grid;
  grid-template-columns: 1fr auto;
  height: auto;
}
.user {
  background: red;
}
.board {
  display: grid;
  grid-template-columns: repeat(15, 50px);
  height: 50px;
}
.board div {
  border: 1px black solid;
}
.board-child div {
  display: inline-block;
}
.board div:hover {
  background: red;
}
.block-style {
  display: grid;
  grid-template-columns: repeat(5, 50px);
}
.empty-block {
  width: 100%;
  height: 50px;
}
.full-block {
  width: 100%;
  height: 50px;
  background: green;
}
.block-box {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  grid-row-gap: 1vh;
}

.block-layout .full-block:hover {
  background: red;
}
</style>