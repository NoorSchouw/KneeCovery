<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>KneeCovery Motion Tracker</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #111;
            color: white;
            font-family: Arial, sans-serif;
        }
        #controls {
            margin: 15px;
        }
        #video-container {
            position: relative;
        }
        video, canvas {
            position: absolute;
            top: 0;
            left: 0;
            transform: scaleX(-1); /* spiegelbeeld voor natuurlijker gevoel */
        }
    </style>

    <!-- TensorFlow.js en Pose Detection library -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.12.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/pose"></script>
</head>

<body>
<h1>KneeCovery Motion Tracking</h1>

<div id="controls">
    <label for="kneeSelect">Kies knie: </label>
    <select id="kneeSelect">
        <option value="left">Linkerknie</option>
        <option value="right">Rechterknie</option>
    </select>
</div>

<div id="video-container">
    <video id="video" width="640" height="480" autoplay playsinline></video>
    <canvas id="output" width="640" height="480"></canvas>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('output');
    const ctx = canvas.getContext('2d');
    const kneeSelect = document.getElementById('kneeSelect');
    let detector, kneeSide = 'left';

    // verander knie als dropdown wordt aangepast
    kneeSelect.addEventListener('change', () => {
        kneeSide = kneeSelect.value;
    });

    // webcam starten
    async function setupCamera() {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: { width: 640, height: 480 },
            audio: false
        });
        video.srcObject = stream;
        return new Promise(resolve => {
            video.onloadedmetadata = () => {
                video.play();
                resolve(video);
            };
        });
    }

    // BlazePose detector laden
    async function initDetector() {
        detector = await poseDetection.createDetector(poseDetection.SupportedModels.BlazePose, {
            runtime: 'mediapipe',
            solutionPath: 'https://cdn.jsdelivr.net/npm/@mediapipe/pose'
        });
    }

    // waaier tekenen (tussen heup, knie, enkel)
    function drawFan(hip, knee, ankle, color, angle) {
        // boog tekenen
        ctx.beginPath();
        ctx.moveTo(knee.x, knee.y);
        ctx.lineTo(hip.x, hip.y);
        ctx.lineTo(ankle.x, ankle.y);
        ctx.closePath();
        ctx.fillStyle = color;
        ctx.globalAlpha = 0.3;
        ctx.fill();
        ctx.globalAlpha = 1;

        // punten tekenen
        [hip, knee, ankle].forEach(pt => {
            ctx.beginPath();
            ctx.arc(pt.x, pt.y, 6, 0, 2 * Math.PI);
            ctx.fillStyle = color;
            ctx.fill();
        });

        // hoektekst weergeven bij de knie
        ctx.font = "20px Arial";
        ctx.fillStyle = color;
        ctx.fillText(`${angle.toFixed(1)}°`, knee.x + 15, knee.y - 10);
    }

    // hoek berekenen
    function calculateAngle(a, b, c) {
        const ab = { x: a.x - b.x, y: a.y - b.y };
        const cb = { x: c.x - b.x, y: c.y - b.y };
        const dot = ab.x * cb.x + ab.y * cb.y;
        const abLen = Math.sqrt(ab.x**2 + ab.y**2);
        const cbLen = Math.sqrt(cb.x**2 + cb.y**2);
        const angle = Math.acos(dot / (abLen * cbLen));
        return angle * (180 / Math.PI);
    }

    async function render() {
        const poses = await detector.estimatePoses(video);
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if (poses.length > 0) {
            const keypoints = poses[0].keypoints;
            const side = kneeSide === 'left' ? 'left' : 'right';
            const hip = keypoints.find(k => k.name === `${side}_hip`);
            const knee = keypoints.find(k => k.name === `${side}_knee`);
            const ankle = keypoints.find(k => k.name === `${side}_ankle`);

            if (hip && knee && ankle) {
                const angle = calculateAngle(hip, knee, ankle);
                const color = (angle > 160 && angle < 180) ? 'limegreen' : 'red';
                drawFan(hip, knee, ankle, color, angle);
            }
        }

        requestAnimationFrame(render);
    }

    async function main() {
        await setupCamera();
        await initDetector();
        render();
    }

    main();
</script>
</body>
</html>
