<?php
// 1. DEFAULT TO GATE
$side = isset($_GET['side']) ? $_GET['side'] : 'gate'; 

$author = "Mark Danielle Cajucom";
$blogTitle = "Venom: Let There Be Carnage";

// 2. THEME CONFIGURATION
if ($side == 'carnage') {
    $charTitle = "The Red Slayer: Carnage";
    $themeColor = "#990000"; // Crimson Red
} else {
    $charTitle = "The Lethal Protector: Venom";
    $themeColor = "#05059b"; // Navy Blue
}

// 3. LONG-FORM CONTENT
$charDesc = ($side == 'carnage') 
    ? "Cletus Kasady is a pure psychopath who views the world through bloodlust. Woody Harrelson portrays a man as dangerous with a pen as he is with a blade. <br><br> Visually, Carnage is a mass of spindly tendrils. He shapeshifts his limbs into an arsenal of axes and hooks, showcasing agility that Venom cannot match." 
    : "Eddie Brock and Venom are essentially a bickering married couple. After a year of sharing a body, the 'honeymoon phase' is over, and their internal conflict makes the character incredibly relatable. <br><br> Tom Hardy's dual performance creates a chaotic, slapstick energy. Venom attempts to establish his own identity, proving he is a sentient being.";

$reactStart = "The film kicks off with breakneck speed, introducing Cletus Kasady at St. Estes Reformatory, establishing the gothic tone. The early scenes in Eddie's apartment are comedic gold, showcasing the struggle of living with an alien parasite.";
$reactMid = "In the middle, chaos erupts. The prison break where Carnage is unleashed is visually impressive. Meanwhile, the 'break-up' between Eddie and Venom adds heart, providing a breather before the heavy climax.";
$reactEnd = "The finale at the cathedral is an atmospheric battleground. The action is tight, and the resolution of Eddie and Venom’s relationship feels earned. The post-credits scene completely changes the trajectory of the franchise.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danielle's Blog: <?php echo $blogTitle; ?></title>
    <style>
        :root { --primary: <?php echo $themeColor; ?>; }
        body, html { margin: 0; padding: 0; background: #000; color: #fff; font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }

        /* --- CINEMATIC TOP HEADER --- */
        .top-header {
            display: <?php echo ($side == 'gate') ? 'flex' : 'none'; ?>;
            position: absolute;
            top: 0; left: 0; width: 100%;
            height: 20vh; /* Slightly taller for more presence */
            align-items: center; justify-content: center;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent); /* Soft fade into the image */
            z-index: 20;
            pointer-events: none;
        }

        .top-header h3 { 
            font-family: 'Metal Mania', system-ui; /* Matches your character names */
            text-transform: uppercase; 
            letter-spacing: 15px; /* Wide spacing looks more premium */
            color: #fff; 
            margin: 0; 
            font-size: 1.4rem; 
            opacity: 0.6; /* Makes it feel like part of the background/atmosphere */
            text-shadow: 0 0 15px rgba(255,255,255,0.3); /* Soft glow */
        }
        /* --- THE GATE --- */
        .gate-container {
            display: <?php echo ($side == 'gate') ? 'flex' : 'none'; ?>;
            height: 100vh; width: 100%; background: #000;
        }

        .side {
            flex: 1; display: flex; align-items: flex-end; justify-content: center;
            padding-bottom: 50px; text-decoration: none; transition: 0.7s ease; 
            overflow: hidden; filter: grayscale(100%); position: relative; z-index: 1;
        }

        /* The Fading Overlays */
        .side::after { content: ""; position: absolute; top: 0; bottom: 0; width: 50%; z-index: 2; }
        .side.venom::after { left: 0; background: linear-gradient(to right, black 40%, transparent); }
        .side.carnage::after { right: 0; background: linear-gradient(to left, black 40%, transparent); }

        .side:hover { flex: 1.15; filter: grayscale(0%); }

        .side.venom { 
            /* Replace 'left center' with your custom percentage */
            background: url('pic/venom.carnage.jpg') -44% center no-repeat; 
            background-size: cover; 
            border-right: 1px solid #111; 
        }

        .side.carnage { 
            /* Replace 'right center' with your custom percentage */
            background: url('pic/venom.carnage.jpg') 144% center no-repeat; 
            background-size: cover; 
        }

        .side h2 { 
            font-family: 'Metal Mania', system-ui;
            position: relative; z-index: 10;
            text-transform: uppercase; font-size: 4.5rem; font-weight: 900;
            text-shadow: 0 0 20px #000; letter-spacing: 5px; margin: 0;
        }
        .side.venom h2 { color: #1010cf; }
        .side.carnage h2 { color: #9a0707; }

        /* --- MAIN REVIEW CONTENT --- */
        .main-review { display: <?php echo ($side != 'gate') ? 'block' : 'none'; ?>; }
        
        .nav-container { text-align: center; padding: 15px; position: fixed; top: 0; left: 0; width: 100%; z-index: 100; background: rgba(0,0,0,0.8); backdrop-filter: blur(10px); transition: top 0.1s ease-in-out; }
        .nav-container.hide { top: -80px; /* Adjust this to match your header's height so it hides completely */}
        
        .change-btn {
            background: var(--primary); color: white; border: none; padding: 10px 25px; 
            border-radius: 50px; font-weight: bold; cursor: pointer; text-transform: uppercase;
            text-decoration: none; font-size: 0.8rem; transition: 0.3s;
        }

        .hero {
            height: 60vh; background: linear-gradient(to bottom, transparent, #000), url('pic/venom_cover.jpg') center center no-repeat;
            background-size: cover; display: flex; align-items: flex-end; padding: 50px; margin-top: 60px;
        }

        .blog-card {
            max-width: 850px; margin: -100px auto 100px; background: #0a0a0a;
            padding: 60px; border-radius: 30px; border-top: 8px solid var(--primary); 
            box-shadow: 0 40px 100px rgba(0,0,0,1);
        }

        h1 { color: var(--primary); font-size: 3.5rem; text-transform: uppercase; margin: 0; font-weight: 900; }
        .label { color: var(--primary); font-weight: bold; display: block; margin-top: 40px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 2px; border-bottom: 1px solid #222; padding-bottom: 5px; }
        .content-text { line-height: 1.8; color: #ccc; font-size: 1.2rem; margin-top: 15px; }
        
        footer { margin-top: 60px; text-align: center; color: #333; font-size: 0.8rem; padding: 20px; }
    </style>
</head>
<body>

    <div class="top-header">
        <h3>SELECT YOUR PERSPECTIVE</h3>
    </div>

    <div class="gate-container">
        <a href="?side=venom" class="side venom"><h2>Venom</h2></a>
        <a href="?side=carnage" class="side carnage"><h2>Carnage</h2></a>
    </div>

    <div class="main-review">
        <div class="nav-container">
            <a href="?side=gate" class="change-btn">Return to Selection</a>
        </div>

        <div class="hero">
            <h1 style="text-shadow: 0 0 25px #000;"><?php echo $charTitle; ?></h1>
        </div>
        
        <article class="blog-card">
            <p style="color: #444; font-size: 0.8rem; text-transform: uppercase;">By <?php echo $author; ?> | Perspective: <?php echo strtoupper($side); ?></p>

            <span class="label">Symbiote Profile</span>
            <p class="content-text"><?php echo $charDesc; ?></p>

            <span class="label">Start: Movie Launch</span>
            <p class="content-text"><?php echo $reactStart; ?></p>

            <span class="label">Mid: The Escalation</span>
            <p class="content-text"><?php echo $reactMid; ?></p>

            <span class="label">End: Final Verdict</span>
            <p class="content-text"><?php echo $reactEnd; ?></p>
            
            <footer>
                PHP Review Engine | Asset: pic/venom.carnage.jpg
            </footer>
        </article>
    </div>

<script>
    let lastScrollY = window.scrollY;
    const nav = document.querySelector('.nav-container');

    window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
            // Scrolling Down - Hide it
            nav.classList.add('hide');
        } else {
            // Scrolling Up - Show it
            nav.classList.remove('hide');
        }
        lastScrollY = window.scrollY;
    });
</script>
</body>
</html>