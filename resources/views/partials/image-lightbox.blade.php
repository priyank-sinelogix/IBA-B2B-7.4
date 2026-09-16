<div id="ibaLightbox" class="iba-lightbox" hidden>
    <button type="button" class="iba-lightbox-close" aria-label="Close">&times;</button>
    <div class="iba-lightbox-zoombar">
        <button type="button" class="iba-lightbox-btn" data-zoom-out aria-label="Zoom out">&minus;</button>
        <button type="button" class="iba-lightbox-btn" data-zoom-in aria-label="Zoom in">+</button>
    </div>
    <img src="" alt="" class="iba-lightbox-img">
</div>

<style>
    img.lightbox-img{ cursor: zoom-in; }
    .iba-lightbox{
        position: fixed; inset: 0; z-index: 3000;
        background: rgba(10,15,20,.88);
        display: flex; align-items: center; justify-content: center;
        padding: 30px;
        overflow: hidden;
        cursor: zoom-out;
    }
    .iba-lightbox[hidden]{ display: none; }
    .iba-lightbox-img{
        max-width: 100%; max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 20px 60px rgba(0,0,0,.5);
        cursor: zoom-in;
        touch-action: none;
        transition: transform .06s linear;
        user-select: none;
        -webkit-user-drag: none;
    }
    .iba-lightbox-close{
        position: fixed; top: 18px; right: 24px; z-index: 3001;
        background: rgba(255,255,255,.12); color: #fff; border: none;
        width: 40px; height: 40px; border-radius: 50%;
        font-size: 1.6rem; line-height: 1; cursor: pointer;
    }
    .iba-lightbox-close:hover{ background: rgba(255,255,255,.22); }
    .iba-lightbox-zoombar{
        position: fixed; left: 50%; bottom: 22px; transform: translateX(-50%); z-index: 3001;
        display: flex; align-items: center; gap: 2px;
        background: rgba(255,255,255,.12); border-radius: 30px; padding: 4px;
    }
    .iba-lightbox-btn{
        background: transparent; color: #fff; border: none; cursor: pointer;
        width: 38px; height: 38px; border-radius: 50%;
        font-size: 1.3rem; line-height: 1; font-weight: 600;
        display: flex; align-items: center; justify-content: center;
    }
    .iba-lightbox-btn:hover{ background: rgba(255,255,255,.18); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var overlay = document.getElementById('ibaLightbox');
        if (!overlay) return;
        var overlayImg = overlay.querySelector('.iba-lightbox-img');

        var scale = 1, panX = 0, panY = 0;
        var isPanning = false, startPointerX = 0, startPointerY = 0, startPanX = 0, startPanY = 0;
        var pinchStartDist = 0, pinchStartScale = 1, isPinching = false;
        var MIN_SCALE = 1, MAX_SCALE = 4;

        function applyTransform() {
            overlayImg.style.transform = 'translate(' + panX + 'px,' + panY + 'px) scale(' + scale + ')';
            overlayImg.style.cursor = scale > 1 ? 'grab' : 'zoom-in';
        }
        function resetZoom() {
            scale = 1; panX = 0; panY = 0;
            applyTransform();
        }
        function zoomTo(newScale) {
            scale = Math.min(MAX_SCALE, Math.max(MIN_SCALE, newScale));
            if (scale === 1) { panX = 0; panY = 0; }
            applyTransform();
        }
        function zoomBy(delta) { zoomTo(scale + delta); }

        function openLightbox(src, alt) {
            if (!src) return;
            overlayImg.src = src;
            overlayImg.alt = alt || '';
            overlay.hidden = false;
            document.body.style.overflow = 'hidden';
            resetZoom();
        }
        function closeLightbox() {
            overlay.hidden = true;
            overlayImg.src = '';
            document.body.style.overflow = '';
            resetZoom();
        }

        document.addEventListener('click', function (e) {
            var img = e.target.closest && e.target.closest('img.lightbox-img');
            if (img) { openLightbox(img.getAttribute('src'), img.getAttribute('alt')); return; }
            if (overlay.hidden) return;
            if (e.target.closest('[data-zoom-in]')) { zoomBy(0.5); return; }
            if (e.target.closest('[data-zoom-out]')) { zoomBy(-0.5); return; }
            if (e.target === overlay || e.target.closest('.iba-lightbox-close')) { closeLightbox(); }
        });

        document.addEventListener('keydown', function (e) {
            if (overlay.hidden) return;
            if (e.key === 'Escape') closeLightbox();
            else if (e.key === '+' || e.key === '=') zoomBy(0.5);
            else if (e.key === '-') zoomBy(-0.5);
            else if (e.key === '0') resetZoom();
        });

        // Scroll wheel zoom
        overlayImg.addEventListener('wheel', function (e) {
            e.preventDefault();
            zoomBy(e.deltaY < 0 ? 0.25 : -0.25);
        }, { passive: false });

        // Double-click / double-tap to toggle zoom
        overlayImg.addEventListener('dblclick', function () {
            zoomTo(scale > 1 ? 1 : 2.5);
        });

        // Drag to pan (mouse + single-finger touch, via Pointer Events)
        overlayImg.addEventListener('pointerdown', function (e) {
            if (scale <= 1 || isPinching) return;
            isPanning = true;
            startPointerX = e.clientX; startPointerY = e.clientY;
            startPanX = panX; startPanY = panY;
            overlayImg.setPointerCapture(e.pointerId);
            overlayImg.style.cursor = 'grabbing';
        });
        overlayImg.addEventListener('pointermove', function (e) {
            if (!isPanning) return;
            panX = startPanX + (e.clientX - startPointerX);
            panY = startPanY + (e.clientY - startPointerY);
            applyTransform();
        });
        function endPan() {
            isPanning = false;
            if (scale > 1) overlayImg.style.cursor = 'grab';
        }
        overlayImg.addEventListener('pointerup', endPan);
        overlayImg.addEventListener('pointercancel', endPan);

        // Two-finger pinch to zoom (touch devices)
        function touchDistance(touches) {
            var dx = touches[0].clientX - touches[1].clientX;
            var dy = touches[0].clientY - touches[1].clientY;
            return Math.sqrt(dx * dx + dy * dy);
        }
        overlayImg.addEventListener('touchstart', function (e) {
            if (e.touches.length === 2) {
                isPinching = true;
                isPanning = false;
                pinchStartDist = touchDistance(e.touches);
                pinchStartScale = scale;
            }
        }, { passive: true });
        overlayImg.addEventListener('touchmove', function (e) {
            if (e.touches.length === 2 && pinchStartDist > 0) {
                e.preventDefault();
                zoomTo(pinchStartScale * (touchDistance(e.touches) / pinchStartDist));
            }
        }, { passive: false });
        overlayImg.addEventListener('touchend', function (e) {
            if (e.touches.length < 2) { isPinching = false; pinchStartDist = 0; }
        });
    });
</script>
