<template>
    <div id="#app">
        <div class="character-buttons">
            <button class="character-buttons-generate" v-on:click="generateCharacter">
                <i class="fas fa-dice" aria-hidden="true"></i> Roll ‘em again
            </button>
            
            <button class="character-buttons-level" v-on:click="increaseLevel">
                <i class="fa fa-level-up" aria-hidden="true"></i> Level up!
            </button>
        </div>

        <div class="character parchment-border">

            <div class="character-name handwritten">
                {{ character.name }}
            </div>
            
            <div class="character-name-form typed">
                NAME
            </div>

            <div class="character-summary-container">
                <div class="character-summary-container-sub characterclass">
                    <div class="character-summary handwritten">
                        {{ character.characterClass }}
                    </div>

                    <div class="character-summary-form typed">
                        CLASS
                    </div>
                </div>

                <div class="character-summary-container-sub characterspecies">
                    <div class="character-summary handwritten">
                        {{ character.species }}
                    </div>

                    <div class="character-summary-form typed">
                        SPECIES
                    </div>
                </div>

                <div class="character-summary-container-sub charactervocation">
                    <div class="character-summary handwritten">
                        {{ character.vocation }}
                    </div>

                    <div class="character-summary-form typed">
                        VOCATION
                    </div>
                </div>

                <div class="character-summary-container-sub characterxp">
                    <div class="character-summary handwritten">
                        {{ character.xp }}
                    </div>

                    <div class="character-summary-form typed">
                        XP
                    </div>
                </div>

                <div class="character-summary-container-sub characterlevel">
                    <div class="character-summary handwritten">
                        {{ character.level }}
                    </div>

                    <div class="character-summary-form typed">
                        LVL
                    </div>
                </div>

            </div>

            <div class="character-vitals">
                <div class="character-vitals-label label-1 typed">HP</div>
                <div class="character-vitals-label label-2 typed">AV</div>
                <div class="character-vitals-label label-3 typed">ST</div>
                <div class="character-vitals-label label-4 typed">AC</div>
                <div class="character-vitals-label label-5 typed">MV</div>
                <div class="character-vitals-value value-1 handwritten">{{ character.hitPoints }}</div>
                <div class="character-vitals-value value-2 handwritten">{{ character.attackValue }}</div>
                <div class="character-vitals-value value-3 handwritten">{{ character.savingThrow }}</div>
                <div class="character-vitals-value value-4 handwritten">{{ character.armorClass }}</div>
                <div class="character-vitals-value value-5 handwritten">30</div>
            </div>

            <div class="character-attributes">
                <div class="character-attributes-label label-1 typed">STR</div>
                <div class="character-attributes-value value-1 handwritten">{{ character.attributes.strength.score }}</div>
                <div class="character-attributes-groups groups-1 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.strength.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.strength.groups).length - 1">, </span></span>
                </div>

                <div class="character-attributes-label label-2 typed">DEX</div>
                <div class="character-attributes-value value-2 handwritten">{{ character.attributes.dexterity.score }}</div>
                <div class="character-attributes-groups groups-2 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.dexterity.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.dexterity.groups).length - 1">, </span></span>
                </div>

                <div class="character-attributes-label label-3 typed">CON</div>
                <div class="character-attributes-value value-3 handwritten">{{ character.attributes.constitution.score }}</div>
                <div class="character-attributes-groups groups-3 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.constitution.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.constitution.groups).length - 1">, </span></span>
                </div>

                <div class="character-attributes-label label-4 typed">INT</div>
                <div class="character-attributes-value value-4 handwritten">{{ character.attributes.intelligence.score }}</div>
                <div class="character-attributes-groups groups-4 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.intelligence.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.intelligence.groups).length - 1">, </span></span>
                </div>

                <div class="character-attributes-label label-5 typed">WIS</div>
                <div class="character-attributes-value value-5 handwritten">{{ character.attributes.wisdom.score }}</div>
                <div class="character-attributes-groups groups-5 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.wisdom.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.wisdom.groups).length - 1">, </span></span>
                </div>

                <div class="character-attributes-label label-6 typed">CHA</div>
                <div class="character-attributes-value value-6 handwritten">{{ character.attributes.charisma.score }}</div>
                <div class="character-attributes-groups groups-6 handwritten">
                    <span v-for="(group, key) in character.attributesWithGroups.charisma.groups" :key="key">{{ group }}<span v-if="key != Object.keys(character.attributesWithGroups.charisma.groups).length - 1">, </span></span>
                </div>
            </div>

            <div class="subcontainer">
                <div class="character-slots">
                    <div class="character-slots-header" style="display: flex;">
                        <span class="typed" style="">SLOTS</span>
                        <span class="handwritten" style="position: relative; bottom: 0.5rem; left: 0.7rem;">({{ character.characterClass }} {{ character.slots.type }})</span>
                    </div>
                    <ul class="character-slots-list handwritten">
                        <li v-for="(slot, key) in character.slots" :key="key">{{ slot.name }}<sup v-if="slot.isActive">*</sup></li>
                    </ul>
                </div>

                <div class="character-languages">
                    <div class="character-languages-header typed">
                        LANGUAGES
                    </div>
                    <ul class="character-languages-list handwritten">
                        <li v-for="(language, key) in character.languages" :key="key">{{ language }}</li>
                    </ul>
                </div>

                <div class="character-quirks">
                    <div class="character-quirks-header typed">
                        APPEARANCE, PERSONALITY, & BACKGROUND
                    </div>
                    <ul class="character-quirks-list handwritten">
                        <li v-for="(descriptor, key) in character.descriptors" :key="key">{{ descriptor }}</li>
                    </ul>
                </div>

                <div class="character-inventory">
                    <div class="character-inventory-header typed">
                        INVENTORY
                    </div>
                    <ul class="character-inventory-list handwritten">
                        <li>£{{ character.currency.gp}}, {{ character.currency.sp}}s, {{ character.currency.cp }}d</li>
                        <li v-for="(item, key) in character.inventory" :key="key">{{ item }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Character } from 'whitehack-char-gen';

let classes = ['Deft', 'Strong', 'Wise'];
var character = new Character(1, classes[Math.floor(Math.random() * classes.length)]);

export default {    
    data() { 
        return {
            character: character,
        }
    },
    methods: {
        generateCharacter: function() {
            // Randomly choose a class.
            let classes = ['Deft', 'Strong', 'Wise'];
            character.generate(1, classes[Math.floor(Math.random() * classes.length)]);
        },
        increaseLevel: function() {
            character.increaseLevel();
        }
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Beth+Ellen&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Special+Elite&display=swap');

.handwritten {
    font-family: 'Beth Ellen', cursive;
    font-size: 1rem;
}

.typed {
    font-family: 'Special Elite', 'Courier New', Courier, monospace;
    font-size: 0.8rem;
}

.character {
    margin: auto;
    margin-bottom: 2rem;
    position: relative;

    background-clip: content-box;
    background-image: url('https://www.parvifolium.net/images/whitehack/sheet_background.jpg');
    background-size: cover;

    // padding: 1rem 0.5rem;
    // border: 1px dashed black;

    border: 30px solid;
    border-image-source: url('https://www.parvifolium.net/images/whitehack/sheet_border.png');
    border-image-slice: 60;
    border-image-width: 4;
    border-image-repeat: round;
}

.character-container .character {
    margin-bottom: 0;
}

.character-buttons {
    display: flex;
    justify-content: center;
    
    &-generate {
        margin: 0.5em;
    }

    &-level {
        margin: 0.5em;
    }
}

.character-name {
    font-size: 1.2rem;
    margin-top: 1rem;
    &.handwritten {
        padding-left: 3px;
    }
    &-form {
        border-top: 1px solid gray;
        margin-top: 0.1rem;
        padding-top: 0.1rem;
    }
}

.character-container .character-name {
    margin-top: 0;
}

.character-summary-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    column-gap: 15px;

    .characterclass {
        grid-column: 1 / span 2;
    }

    .characterspecies {
        grid-column: 3 / span 2;
    }

    .charactervocation {
        grid-column: 5 / span 4;
    }

    @media (max-width: 580px) {
        grid-template-rows: 1fr 1fr;

        .characterclass {
            grid-column: 1 / span 3;
            grid-row: 1 / span 1;
        }
    
        .characterspecies {
            grid-column: 4 / span 3;
            grid-row: 1 / span 1;
        }

        .characterxp {
            grid-column: 7 / span 2;
            grid-row: 1 / span 1;
        }

        .characterlevel {
            grid-column: 9 / span 2;
            grid-row: 1 / span 1;
        }

        .charactervocation {
            grid-column: 1 / span 10;
            grid-row: 2 / span 1;
        }
    }

    @media (max-width: 430px) {
        grid-template-rows: 1fr 1fr;

        .characterclass {
            grid-column: 1 / span 4;
            grid-row: 1 / span 1;
        }

        .characterxp {
            grid-column: 5 / span 4;
            grid-row: 1 / span 1;
        }

        .characterlevel {
            grid-column: 9 / span 2;
            grid-row: 1 / span 1;
        }
    
        .characterspecies {
            grid-column: 1 / span 4;
            grid-row: 2 / span 1;
        }

        .charactervocation {
            grid-column: 5 / span 6;
            grid-row: 2 / span 1;
        }
    }

    @media (max-width: 380px) {
        grid-template-rows: 1fr 1fr 1fr;

        .characterclass {
            grid-column: 1 / span 4;
            grid-row: 1 / span 1;
        }

        .characterxp {
            grid-column: 5 / span 4;
            grid-row: 1 / span 1;
        }

        .characterlevel {
            grid-column: 9 / span 2;
            grid-row: 1 / span 1;
        }
    
        .characterspecies {
            grid-column: 1 / span 10;
            grid-row: 2 / span 1;
        }

        .charactervocation {
            grid-column: 1 / span 10;
            grid-row: 3 / span 1;
        }
    }
}

.character-summary {
    font-size: 1.2rem;
    &.handwritten {
        padding-left: 3px;
    }

    &-form {
        border-top: 1px solid gray;
        margin-top: 0.1rem;
        padding-top: 0.1rem;
    }
}

.character-vitals {
    column-gap: 5%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    margin-top: 1.5rem;
    &-label {
        align-self: center;
        justify-self: left;
        grid-row: 1 / span 1;
        &.label-1 {
            grid-column: 1 / span 1;
        }
        &.label-2 {
            grid-column: 2 / span 1;
        }
        &.label-3 {
            grid-column: 3 / span 1;
        }
        &.label-4 {
            grid-column: 4 / span 1;
        }
        &.label-5 {
            grid-column: 5 / span 1;
        }
    }
    &-value {
        align-self: center;
        justify-self: center;
        grid-row: 1 / span 2;

        border-right: 1px solid gray;
        height: 100%;
        padding-left: 30%;
        width: 70%;

        @media (max-width: 480px) {
            padding-left: 40%;
            width: 60%;
        }

        &.value-1 {
            grid-column: 1 / span 1;
        }
        &.value-2 {
            grid-column: 2 / span 1;
        }
        &.value-3 {
            grid-column: 3 / span 1;
        }
        &.value-4 {
            grid-column: 4 / span 1;
        }
        &.value-5 {
            grid-column: 5 / span 1;
            border-right: none;
        }
    }
}

.character-attributes {
    column-gap: 10px;
    display: grid;
    grid-template-columns: 2rem 2rem auto;
    grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr;
    margin-top: 1.5rem;
    max-width: 720px;
    row-gap: 3px;

    @media (max-width: 480px) {
        column-gap: 0px;
    }

    &-label {
        align-self: center;
        grid-column: 1 / span 1;
        justify-self: left;
        &.label-1 {
            grid-row: 1 / span 1;
        }
        &.label-2 {
            grid-row: 2 / span 1;
        }
        &.label-3 {
            grid-row: 3 / span 1;
        }
        &.label-4 {
            grid-row: 4 / span 1;
        }
        &.label-5 {
            grid-row: 5 / span 1;
        }
        &.label-6 {
            grid-row: 6 / span 1;
        }
    }
    &-value {
        align-self: center;
        grid-column: 2 / span 1;
        justify-self: center;

        @media (max-width: 480px) {
            justify-self: left;
        }

        &.value-1 {
            grid-row: 1 / span 1;
        }
        &.value-2 {
            grid-row: 2 / span 1;
        }
        &.value-3 {
            grid-row: 3 / span 1;
        }
        &.value-4 {
            grid-row: 4 / span 1;
        }
        &.value-5 {
            grid-row: 5 / span 1;
        }
        &.value-6 {
            grid-row: 6 / span 1;
        }
    }
    &-groups {
        align-self: center;
        grid-column: 3 / span 1;
        justify-self: left;
        &.groups-1 {
            grid-row: 1 / span 1;
        }
        &.groups-2 {
            grid-row: 2 / span 1;
        }
        &.groups-3 {
            grid-row: 3 / span 1;
        }
        &.groups-4 {
            grid-row: 4 / span 1;
        }
        &.groups-5 {
            grid-row: 5 / span 1;
        }
        &.groups-6 {
            grid-row: 6 / span 1;
        }
    }
}

.subcontainer {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 15px;

    @media (max-width: 760px) {
        display: block;
    }

    .character-slots {
        margin-top: 1.5rem;
        ul {
            margin: 0;
            padding: 0;

            margin-left: 1rem;
            li {
                list-style: "-";
                line-height: 1.4em;
                padding-left: 0.2rem;
            }
        }
    }

    .character-languages {
        margin-top: 1.5rem;
        ul {
            margin: 0;
            padding: 0;

            margin-left: 1rem;
            li {
                list-style: "-";
                line-height: 1.4em;
                padding-left: 0.2rem;
            }
        }
    }

    .character-quirks {
        margin-top: 1.5rem;
        ul {
            margin: 0;
            padding: 0;
            li {
                list-style: "-";
                line-height: 1.4em;
                padding-left: 1.2rem;

                text-indent: -1rem;
                margin-left: 1rem;
            }
        }
    }

    .character-inventory {
        margin-top: 1.5rem;
        ul {
            columns: 2;
    
            @media (max-width: 540px) {
                columns: 1; 
            }

            margin: 0;
            padding: 0;
            margin-left: 1rem;
            li {
                list-style: "-";
                line-height: 1.4em;
                padding-left: 0.2rem;
            }
        }
    }
}
</style>