# title
RuneLite Screenshot Level Scanner

# posted_at
2021-02-10T10:09:00+00:00

# category
game

# summary
A quick utility that scans RuneLite for level-up screenshots and populates a chart of levels over time.

# body
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script src="/js/runelite-level-scanner.js"></script>

If you've always used an XP tracker like [TempleOSRS](https://templeosrs.com/) or [Wise Old Man](https://www.wiseoldman.net/), then you probably don't need a tool for this. But if you don't, and you do use RuneLite, you can still take a look back at your progress over time!

By default, RuneLite takes screenshots of most level-ups. This tool scans selected file names for skill names and levels, and file metadata for date and time. None of the screenshots are uploaded, and no information is saved. You can find your screenshot folder by right-clicking the screenshot icon in RuneLite:

![text](/img/posts/runelite_screenshot.png)

## How To Use
1. Select all your level-up screenshots
2. Click "Done"
3. Click the legends of individual skills to hide and unhide them

<div style="margin: auto; width: fit-content;">
    <input id="fileItem" type="file" multiple>
    <button onclick="parseFiles()">Done</button>
</div>

<canvas id="myChart" width="100" height="70" style="margin-top: 1rem;"></canvas>

<div style="margin: auto; width: fit-content;">
    <button onclick="displayAll(true)">Display All</button>
    <button onclick="displayAll(false)">Hide All</button>
</div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [],
        },
        options: {
            responsive: true,
            legend: {
                align: 'start',
                position: 'right',
                labels: {
                    boxWidth: 20,
                    fontFamily: "monospace",
                    padding: 10,
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 1,
                        max: 99,
                    }
                }],
            }
        },
    });
</script>

## Issues
- Depending on how long you've used RuneLite, your level-up screenshots may be saved in multiple folders. For example, my earliest screenshots are saved in `C:\Users\Blaine\.runelite\screenshots\Zelaku`, while my more recent screenshots are saved in `C:\Users\Blaine\.runelite\screenshots\Zelaku\Levels`.
- If you've modified any of your level-up screenshots, the displayed times may not be accurate.

## Fun Stuff
You can see those satisfying jumps from completing early quests. Waterfall Quest is a clear standout:

![text](/img/posts/runelite_scanner_waterfallquest.png)

It's obvious I was a F2P noob as a kid; it took me a long time to figure out farming and construction:

![text](/img/posts/runelite_scanner_farmingconstruction.png)