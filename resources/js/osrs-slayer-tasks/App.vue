<template>
    <div id="#app">
        <transition name="slide-fade" @after-enter="lowerError">
            <div v-if="error.display" class="error-message" :style="error.style">
                {{ error.message }}
            </div>
        </transition>

        <h2>Levels</h2>
        <button class="unlock-all" @click="slayer.maxAllRequiredSkills()">Max All</button>
        <div class="levels">
            <img src="/img/osrs/skill_combat.png" alt="">
            <span>Combat</span>
            <input type="number" :value="slayer.combatLevel" @change="updateCombatLevel">
        
            <img src="/img/osrs/skill_slayer.png" alt="">
            <span>Slayer</span>
            <input type="number" :value="slayer.slayerLevel" @change="updateSlayerLevel">

            <img src="/img/osrs/skill_agility.png" alt="">
            <span>Agility</span>
            <input type="number" :value="slayer.agilityLevel" @change="updateAgilityLevel">

            <img src="/img/osrs/skill_defence.png" alt="">
            <span>Defence</span>
            <input type="number" :value="slayer.defenceLevel" @change="updateDefenceLevel">

            <img src="/img/osrs/skill_firemaking.png" alt="">
            <span>Firemaking</span>
            <input type="number" :value="slayer.firemakingLevel" @change="updateFiremakingLevel">

            <img src="/img/osrs/skill_magic.png" alt="">
            <span>Magic</span>
            <input type="number" :value="slayer.magicLevel" @change="updateMagicLevel">

            <img src="/img/osrs/skill_strength.png" alt="">
            <span>Strength</span>
            <input type="number" :value="slayer.strengthLevel" @change="updateStrengthLevel">
        </div>

        <h2>Masters</h2>
        <ul class="masters">
            <li
                v-for="master in slayerMasters"
                :key="master.id"
                @click="updateSlayerMaster(master.id, $event)">
                <div class="checkbox radio" :class="{ checked: slayer.slayerMaster.id === master.id }"></div>
                <img :src="'/img/osrs/' + master.id + '_chathead.png'" alt="">
                {{ master.name }}
            </li>
        </ul>

        <h2>Quests</h2>
        <button class="unlock-all" @click="slayer.completeAllQuests()">Complete All</button>

        <div class="quest-points">
            <span>Quest Points</span>
            <input type="number" v-model.number="slayer.questPoints">
        </div>

        <ul class="quest-unlocks">
            <li
                v-for="(completed, questId) in slayer.completedQuests"
                :key="questId"
                :class="{ unlocked: completed }"
                @click="slayer.toggleQuest(questId)">
                <div class="checkbox" :class="{ checked: completed }"></div>
                {{ slayer.questNameById(questId) }}
            </li>
        </ul>

        <h2>Rewards</h2>
        <button class="unlock-all" @click="slayer.unlockAllRewards()">Unlock All</button>
        <ul class="reward-unlocks">
            <li
                v-for="(unlocked, rewardId) in slayer.unlockedRewards"
                :key="rewardId"
                :class="{ unlocked: unlocked }"
                @click="slayer.toggleReward(rewardId)">
                <div class="checkbox" :class="{ checked: unlocked }"></div>
                <img :src="'/img/osrs/unlock_' + rewardId + '.png'" alt="">
                {{ slayer.rewardNameById(rewardId) }}
            </li>
        </ul>

        <h2>Miscellaneous</h2>
        <button class="unlock-all" @click="slayer.unlockAllMiscellaneous()">Unlock All</button>
        <ul class="miscellaneous-unlocks">
            <li
                :class="{ unlocked: slayer.miscellaneousUnlocks.ancientCavern }"
                @click="slayer.miscellaneousUnlocks.ancientCavern = !slayer.miscellaneousUnlocks.ancientCavern">
                <div class="checkbox" :class="{ checked: slayer.miscellaneousUnlocks.ancientCavern }"></div>
                Entered Ancient Cavern</li>

            <li
                :class="{ unlocked: slayer.miscellaneousUnlocks.lumbridgeEliteDiary }"
                @click="slayer.miscellaneousUnlocks.lumbridgeEliteDiary = !slayer.miscellaneousUnlocks.lumbridgeEliteDiary">
                <div class="checkbox" :class="{ checked: slayer.miscellaneousUnlocks.lumbridgeEliteDiary }"></div>
                Completed Lumbridge & Draynor Elite Diary</li>
        </ul>

        <h2>Tasks</h2>
        <ul class="tasks">
            <li
                v-for="task in slayer.tasks"
                :key="task.id"
                class="task"
                :class="{ unavailable: !task.available, blocked: !task.unblocked }"
                @click="slayer.toggleBlock(task.monsterId)">
                <span class="task-name">{{ slayer.monsterNameById(task.monsterId) }}</span> <span class="task-probability">{{ formatAsPercent(task.probability) }}</span>
            </li>
        </ul>

        <h2>Blocks</h2>
        <button class="unlock-all" @click="slayer.unblockAllTasks()">Unblock All</button>
        <ul class="blocked-tasks">
            <li :class="{ unavailable: slayer.availableBlockCount < 1 }">
                <span>Blocked Task 1</span>
                <select
                    data-index="0"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[0]" :value="slayer.blockArray[0]">{{ slayer.monsterNameById(slayer.blockArray[0]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
            <li :class="{ unavailable: slayer.availableBlockCount < 2 }">
                <span>Blocked Task 2</span>
                <select
                    data-index="1"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[1]" :value="slayer.blockArray[1]">{{ slayer.monsterNameById(slayer.blockArray[1]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
            <li :class="{ unavailable: slayer.availableBlockCount < 3 }">
                <span>Blocked Task 3</span>
                <select
                    data-index="2"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[2]" :value="slayer.blockArray[2]">{{ slayer.monsterNameById(slayer.blockArray[2]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
            <li :class="{ unavailable: slayer.availableBlockCount < 4 }">
                <span>Blocked Task 4</span>
                <select
                    data-index="3"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[3]" :value="slayer.blockArray[3]">{{ slayer.monsterNameById(slayer.blockArray[3]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
            <li :class="{ unavailable: slayer.availableBlockCount < 5 }">
                <span>Blocked Task 5</span>
                <select
                    data-index="4"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[4]" :value="slayer.blockArray[4]">{{ slayer.monsterNameById(slayer.blockArray[4]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
            <li :class="{ unavailable: slayer.availableBlockCount < 6 }">
                <span>Blocked Task 6</span>
                <select
                    data-index="5"
                    @input="blockedTasksInput">
                    <option v-if="slayer.blockArray[5]" :value="slayer.blockArray[5]">{{ slayer.monsterNameById(slayer.blockArray[5]) }}</option>
                    <option value="none">None</option>
                    <option
                        v-for="monsterId in unblockedMonsterIds()"
                        :key="monsterId"
                        :value="monsterId">{{ slayer.monsterNameById(monsterId) }}</option>
                </select>
            </li>
        </ul>
    </div>
</template>

<script>
import { Slayer, slayerMasters } from 'osrs-slayer-tasks';

var slayer = new Slayer;

export default {
    data() {
        return {
            slayer: slayer,
            slayerMasters: slayerMasters,
            error: {
                display: false,
                message: "",
                style: "",
            },
        }
    },
    methods: {
        raiseError: function (errorMessage, positionX, positionY) {
            this.error.display = true;
            this.error.message = errorMessage;
            this.error.style = "left: " + positionX + "px; top: " + positionY + "px;";
        },
        lowerError: function () {
            this.error.display = false;
            this.error.message = "";
            this.error.style = "";
        },
        unblockedMonsterIds: function () {
            var unblockedMonsterIds = [];
            for (const monsterId in slayer.blockList) {
                if (!slayer.blockArray.includes(monsterId)) {
                    unblockedMonsterIds.push(monsterId);
                }
            }
            return unblockedMonsterIds;
        },
        blockedTasksInput: function (event) {
            const monsterId = event.target.value;
            const arrayIndex = event.target.dataset.index;
            this.slayer.unblockTaskByIndex(arrayIndex);
            this.slayer.blockTask(monsterId, arrayIndex);
        },
        updateCombatLevel: function (event) {
            const value = event.target.value;
            if (value > 126) {
                this.slayer.combatLevel = 126;
            } else if (value < 3) {
                this.slayer.combatLevel = 3;
            } else {
                this.slayer.combatLevel = value;
            }

            this.$forceUpdate();
        },
        updateSlayerLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.slayerLevel = 99;
            } else if (value < 1) {
                this.slayer.slayerLevel = 1;
            } else {
                this.slayer.slayerLevel = value;
            }

            this.$forceUpdate();
        },
        updateAgilityLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.agilityLevel = 99;
            } else if (value < 1) {
                this.slayer.agilityLevel = 1;
            } else {
                this.slayer.agilityLevel = value;
            }

            this.$forceUpdate();
        },
        updateDefenceLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.defenceLevel = 99;
            } else if (value < 1) {
                this.slayer.defenceLevel = 1;
            } else {
                this.slayer.defenceLevel = value;
            }

            this.$forceUpdate();
        },
        updateFiremakingLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.firemakingLevel = 99;
            } else if (value < 1) {
                this.slayer.firemakingLevel = 1;
            } else {
                this.slayer.firemakingLevel = value;
            }

            this.$forceUpdate();
        },
        updateMagicLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.magicLevel = 99;
            } else if (value < 1) {
                this.slayer.magicLevel = 1;
            } else {
                this.slayer.magicLevel = value;
            }

            this.$forceUpdate();
        },
        updateStrengthLevel: function (event) {
            const value = event.target.value;
            if (value > 99) {
                this.slayer.strengthLevel = 99;
            } else if (value < 1) {
                this.slayer.strengthLevel = 1;
            } else {
                this.slayer.strengthLevel = value;
            }

            this.$forceUpdate();
        },
        updateSlayerMaster: function (masterId, event) {
            try {
                slayer.updateSlayerMaster(masterId);
            } catch (error) {
                // Create error alert for user.
                this.raiseError(error.message, event.pageX, event.pageY);
            }
        },
        blockedTask: function (count) {
            if (this.slayer.blockedTaskCount >= count) {
                let blockCount = 0;
                for (const monsterId in this.slayer.blockList) {
                    if (this.slayer.blockList[monsterId]) {
                        blockCount++;
                        if (blockCount === count) {
                            return monsterId;
                        }
                    }
                }
            } else {
                return null;
            }
        },
        formatAsPercent: function (num) {
            return (num * 100).toFixed(1) + '%';
        }
    },
}
</script>

<style lang="scss" scoped>
.error-message {
    position: absolute;
    background-color: rgb(223, 169, 169);
    border: 1px solid rgb(238, 113, 113);
    color: 1px solid rgb(238, 113, 113);
    padding: 5px;
    border-radius: 4px;
}

.slide-fade-enter-active {
    transition: all 0.3s ease;
}

.slide-fade-leave-active {
    transition: all 2s ease-in;
}

.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}

h2 {
    border-bottom: 2px solid rgb(139, 0, 0);
    margin-top: 1em;
    margin-bottom: 0.5em;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;

    li {
        cursor: pointer;
        
        &:not(:last-child) {
            padding-bottom: 0.2em;
        }
    }
}

button.unlock-all {
    margin: 0 0 0.8rem 0;
}

div.checkbox {
    background-color: none;
    border: 1px solid rgb(177, 177, 177);
    border-radius: 2px;
    display: inline-block;
    height: 20px;
    width: 20px;

    text-align: center;
    line-height: 22px;

    &.radio {
        border-radius: 10px;
    }

    &::before {
        color: rgb(177, 177, 177);
        content: "✘";
    }

    &.checked {
        background-color: rgba(139, 0, 0, 0.1);
        border: 1px solid rgb(139, 0, 0);
        &::before {
            color: rgb(139, 0, 0);
            content: "✔";
        }
    }
}

div.levels {
    align-items: center;
    column-gap: 0.5rem;
    display: grid;
    grid-template-columns: 24px min-content auto;
    row-gap: 0.5rem;

    img {
        justify-self: center;
    }

    input {
        max-width: 3rem;
    }
}

div.quest-points {
    margin-bottom: 0.5rem;
    
    span {
        padding-right: 0.5rem;
    }

    input {
        max-width: 3rem;
    }
}

ul.masters {
    li {
        align-items: center;
        display: flex;

        img {
            height: 36px;
            object-fit: contain;
            padding: 0 0.3rem;
            width: 48px;
        }
    }
}

ul.quest-unlocks, ul.reward-unlocks, ul.miscellaneous-unlocks {
    li {
        color: rgb(177, 177, 177);

        &.unlocked {
            color: unset;
        }
    }
}

ul.reward-unlocks {
    li {
        align-items: center;
        display: flex;

        img {
            height: 36px;
            object-fit: contain;
            padding: 0 0.3rem;
            width: 24px;
        }
    }
}

ul.tasks {
    li.task {
        display: flex;
        justify-content: space-between;
        padding: 0.2em 0.4em;

        &:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    }
    
    li.unavailable {
        color: lightgray;
    }

    li.blocked {
        color: orangered;
    }
}

ul.blocked-tasks {
    li {
        display: flex;
        justify-content: space-between;

        select {
            option {
                min-width: 150px;
            }
        }

        &.unavailable {
            color: lightgray;
            select {
                background-color: rgba(0, 0, 0, 0.005);
                border-color: lightgray;
                color: lightgray;
            }
        }
    }
}
</style>