// Define skillnames and associated colors for display. These colors match those used in RuneLite.
const skills = [
    { name: "Attack", color: 'rgba(155, 32, 7, 1)' },
    { name: "Strength", color: 'rgba(4, 149, 90, 1)' },
    { name: "Defence", color: 'rgba(98, 119, 190, 1)' },
    { name: "Ranged", color: 'rgba(109, 144, 23, 1)' },
    { name: "Prayer", color: 'rgba(159, 147, 35, 1)' },
    { name: "Magic", color: 'rgba(50, 80, 193, 1)' },
    { name: "Runecraft", color: 'rgba(170, 141, 26, 1)' },
    { name: "Construction", color: 'rgba(130, 116, 95, 1)' },
    { name: "Hitpoints", color: 'rgba(131, 126, 126, 1)' },
    { name: "Agility", color: 'rgba(58, 60, 137, 1)' },
    { name: "Herblore", color: 'rgba(7, 133, 9, 1)' },
    { name: "Thieving", color: 'rgba(108, 52, 87, 1)' },
    { name: "Crafting", color: 'rgba(151, 110, 77, 1)' },
    { name: "Fletching", color: 'rgba(3, 141, 125, 1)' },
    { name: "Slayer", color: 'rgba(100, 100, 100, 1)' },
    { name: "Hunter", color: 'rgba(92, 89, 65, 1)' },
    { name: "Mining", color: 'rgba(93, 143, 167, 1)' },
    { name: "Smithing", color: 'rgba(108, 107, 82, 1)' },
    { name: "Fishing", color: 'rgba(106, 132, 164, 1)' },
    { name: "Cooking", color: 'rgba(112, 35, 134, 1)' },
    { name: "Firemaking", color: 'rgba(189, 120, 25, 1)' },
    { name: "Woodcutting", color: 'rgba(52, 140, 37, 1)' },
    { name: "Farming", color: 'rgba(101, 152, 63, 1)' },
];

// Initialize the global array for skill data.
window.skillData = [];

function getMaxLevel(skillData, unixtime, skillname) {
    let dataSubset = skillData.filter(obj => obj.skill === skillname && obj.unixtime <= unixtime);
    if (dataSubset.length === 0) {
        return 1;
    } else {
        return Math.max(...dataSubset.map(obj => obj.level));
    }
}

function displayAll(flag) {
    if (flag) {
        // Toggle all traces on.
        for (let i = 0; i < myChart.legend.legendItems.length; i++) {
            let legendItem = myChart.legend.legendItems[i];
            var meta = myChart.getDatasetMeta([legendItem.datasetIndex]);
            meta.hidden = false;
            myChart.update();
        }
    } else {
        // Toggle all traces off.
        for (let i = 0; i < myChart.legend.legendItems.length; i++) {
            let legendItem = myChart.legend.legendItems[i];
            var meta = myChart.getDatasetMeta([legendItem.datasetIndex]);
            meta.hidden = true;
            myChart.update();
        }
    }
}

function parseFiles() {
    // Read all files in the input element.
    var files = document.getElementById('fileItem').files;

    // Define the regular expression for matching to one of the 23 skill names.
    let skillRegexString = '(';
    for (let i = 0; i < skills.length; i++) {
        skillRegexString += skills[i].name + '|';
    }
    skillRegexString = skillRegexString.substring(0, skillRegexString.length - 1) + ')';
    skillRegex = new RegExp(skillRegexString);

    // Loop through each selected file.
    // Level-up images should contain the skill name, as well as the level in parentheses.
    for (let i = 0; i < files.length; i++) {
        let file = files[i];
        let skillnameMatch = file.name.match(skillRegex);
        let levelMatch = file.name.match(/\([0-9]*\)/);

        if (!skillnameMatch || !levelMatch) {
            continue;
        } else {
            // If we match both the skill name and the level, push an object to the global array.
            // This object contains the skill name, the level, and the last file modification in epoch time.
            let skillname = skillnameMatch[0];
            let level = parseInt((levelMatch[0].replace("\(", "").replace("\)", "")));
            window.skillData.push({ skill: skillname, level: level, unixtime: file.lastModified});
        }
    }

    // Create a new array.
    // Grab all timestamps from current data and sort from low to high.
    let timeseriesData = [];
    let unixtimes = [...window.skillData.map(obj => obj.unixtime).sort()];
    
    // Loop through every skill.
    for (let i = 0; i < unixtimes.length; i++) {
        // Find max value of each skill among timestamps that are less than or equal to the current timestamp.
        unixtime = unixtimes[i];
        timeseriesData.push({
            unixtime: unixtime,
            Attack: getMaxLevel(window.skillData, unixtime, "Attack"),
            Strength: getMaxLevel(window.skillData, unixtime, "Strength"),
            Defence: getMaxLevel(window.skillData, unixtime, "Defence"),
            Ranged: getMaxLevel(window.skillData, unixtime, "Ranged"),
            Prayer: getMaxLevel(window.skillData, unixtime, "Prayer"),
            Magic: getMaxLevel(window.skillData, unixtime, "Magic"),
            Runecraft: getMaxLevel(window.skillData, unixtime, "Runecraft"),
            Construction: getMaxLevel(window.skillData, unixtime, "Construction"),
            Hitpoints: getMaxLevel(window.skillData, unixtime, "Hitpoints"),
            Agility: getMaxLevel(window.skillData, unixtime, "Agility"),
            Herblore: getMaxLevel(window.skillData, unixtime, "Herblore"),
            Thieving: getMaxLevel(window.skillData, unixtime, "Thieving"),
            Crafting: getMaxLevel(window.skillData, unixtime, "Crafting"),
            Fletching: getMaxLevel(window.skillData, unixtime, "Fletching"),
            Slayer: getMaxLevel(window.skillData, unixtime, "Slayer"),
            Hunter: getMaxLevel(window.skillData, unixtime, "Hunter"),
            Mining: getMaxLevel(window.skillData, unixtime, "Mining"),
            Smithing: getMaxLevel(window.skillData, unixtime, "Smithing"),
            Fishing: getMaxLevel(window.skillData, unixtime, "Fishing"),
            Cooking: getMaxLevel(window.skillData, unixtime, "Cooking"),
            Firemaking: getMaxLevel(window.skillData, unixtime, "Firemaking"),
            Woodcutting: getMaxLevel(window.skillData, unixtime, "Woodcutting"),
            Farming: getMaxLevel(window.skillData, unixtime, "Farming"),
        });
    }

    var datasets = [];
    for (let i = 0; i < skills.length; i++) {
        datasets.push({
            label: skills[i].name,
            data: timeseriesData.map(obj => obj[skills[i].name]),
            backgroundColor: skills[i].color,
            borderColor: skills[i].color,
            fill: false,
            steppedLine: 'before',
            pointRadius: 0,
        });
    }

    // Replace current data with the updated version and refresh the chart.
    myChart.data.labels = unixtimes;
    myChart.data.datasets = datasets;
    myChart.update();
}