<head>
    <title>PoudlardExpress</title>
    <script src="x3dom/x3dom.js"></script>
    <link rel="stylesheet" href="x3dom/x3dom.css">

    <script src="fontawesome/js/all.js"></script>

    <link rel="stylesheet" href="index.css"/>
</head>
<body>
    <h1>Poudlard express</h1>
    <div class="main-wrapper">
        <div class="main-container">
            <div class="train-map--container">
                <div class="train-map">
                    <img src="public/train.png"/>
                    <div class="train-map--wrapper">
                        <div class="train-map--area" viewpoint="a"> </div>
                        <div class="train-map--area" viewpoint="b"> </div>
                        <div class="train-map--area" viewpoint="c"> </div>
                        <div class="train-map--area" viewpoint="d"> </div>
                        <div class="train-map--area" viewpoint="e"> </div>
                    </div>
                </div>
            </div>
            <x3d width='90vw' height='90vh'>
                <scene>
                    <?php
                        include("train.php");
                    ?>
                    
                    <viewpoint id="initial_viewpoint" position="-55 4 16" orientation="0 -1 0 1.6"></viewpoint>

                    <viewpoint id="a" position="-13 4 -11.5" orientation="0 -1 0 1.6"></viewpoint>
                    <viewpoint id="b" position="0 4 -3" orientation="0 1 0 3.13"></viewpoint>
                    <viewpoint id="c" position="0 4 12" orientation="0 1 0 3.13"></viewpoint>
                    <viewpoint id="d" position="0 30 30" orientation="-1 0 0 1.6"></viewpoint>
                    <viewpoint id="e" position="11 8 62" orientation="-0.3 1 0 0.8"></viewpoint>
                </scene>
            </x3d>
        </div>
    </div>

    <div onclick="hidePopup()" style="display: none;" id="popup_container"></div>
</body>

<script>
    const initialViewpoint = document.getElementById("initial_viewpoint");
    
    const switchToViewpoint = (viewpoint) => {
        viewpoint.setAttribute("set_bind", "false");
        viewpoint.setAttribute("set_bind", "true");
    };

    const mapAreas = document.getElementsByClassName("train-map--area");
    console.log(mapAreas);
    Array.from(mapAreas).forEach((area) => {
        area.onclick = (event) => {
            const viewpoint = document.getElementById(area.getAttribute("viewpoint"));
            switchToViewpoint(viewpoint);
        }
    });

    window.addEventListener('load', () => {
        switchToViewpoint(initialViewpoint);
    });

    const openPopup = (popup) => {
        document.getElementById("popup_container");
        popup_container.innerHTML = popup;
        popup_container.style.display = "block";
    }

    const hidePopup = () => {
        document.getElementById("popup_container");
        popup_container.innerHTML = "";
        popup_container.style.display = "none";
    }

    const generatePopup = (content) => {
        return (`
            <div class="popup_wrapper">
                <div class="popup" onclick="event.stopPropagation();">
                    <div class="popup__close" onclick="hidePopup()"><span style="color: grey;"><i class="fas fa-times fa-2x"></i></span></div>
                    <div class="content">
                        ${content}
                    </div>
                </div>
            </div>
        `);
    }

    const generateGreenCubePopup = () => {
        return generatePopup(`
            <h2>Menu</h2>
            <div>
                <ul>
                    <li>1</li>
                    <li>2</li>
                </ul>
            </div>
        `)
    }

    const generateBlueCubePopup = () => {
        return generatePopup(`
            <h2>Autre</h2>
            <div>
                Un autre contenu    
            </div>
        `)
    }

    const handleGreenCubeClick = (event) => {
        const popupContent = generateGreenCubePopup();
        openPopup(popupContent);
    }

    const handleBlueCubeClick = (event) => {
        const popupContent = generateBlueCubePopup();
        openPopup(popupContent);
    }
</script>