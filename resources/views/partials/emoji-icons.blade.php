<style>
    .site-icon { display:inline-grid; width:1.15em; height:1.15em; place-items:center; vertical-align:-.18em; color:var(--gold2, #e5a72f); }
    .site-icon svg { width:100%; height:100%; fill:none; stroke:currentColor; stroke-linecap:round; stroke-linejoin:round; stroke-width:1.8; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var iconPaths = {
            128200: '<path d="M4 19 10 13l4 4 6-8"/><path d="M15 9h5v5"/>',
            128202: '<path d="M4 19V5h16v14H4Z"/><path d="M8 15v-3M12 15V8M16 15v-5"/>',
            127970: '<path d="M4 20V8l8-4 8 4v12M2 20h20M8 20v-5h8v5M8 9h.01M12 9h.01M16 9h.01"/>',
            9989: '<path d="m5 12 4 4L19 6"/>',
            128101: '<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 20c.5-3.5 2.3-5 5.5-5s5 1.5 5.5 5M14 15c3-.7 5.5.7 6 4"/>',
            128188: '<path d="M4 7h16v13H4zM8 7V5h8v2M8 12h8M8 16h5"/>',
            127981: '<path d="M4 20V9h16v11M2 20h20M7 9V5h4v4M15 9V3h4v6M8 13h.01M12 13h.01M16 13h.01"/>',
            129309: '<path d="M8 12V5a2 2 0 0 1 4 0v6-7a2 2 0 0 1 4 0v7-5a2 2 0 0 1 4 0v8c0 4-2.5 7-7 7h-2c-2 0-3.5-1-4.5-2.5L3 14a2 2 0 0 1 3-2l2 2Z"/>',
            128203: '<path d="M6 4h12v17H6zM9 2h6v4H9M9 10h6M9 14h6M9 18h4"/>',
            128221: '<path d="M5 3h14v18H5zM8 7h8M8 11h8M8 15h5"/>',
            128276: '<path d="M6 17h12l-1.5-2V9a4.5 4.5 0 0 0-9 0v6L6 17ZM10 20h4"/>',
            128172: '<path d="M3 5h18v11H8l-5 4V5ZM7 9h10M7 12h6"/>',
            128167: '<path d="M12 3S5.5 10.2 5.5 14.7a6.5 6.5 0 0 0 13 0C18.5 10.2 12 3 12 3Z"/>',
            127793: '<path d="M5 20c0-7 3.8-11.5 11-13 1.1 5.7-1.6 10.4-8 12.2M5 20c2.6-3.8 5.3-6.2 9-8.4"/>',
            128154: '<path d="M12 20.5S4 15.7 4 9.5A4.5 4.5 0 0 1 12 7a4.5 4.5 0 0 1 8 2.5c0 6.2-8 11-8 11Z"/><path d="M12 8v6M9 11h6"/>',
            128737: '<path d="M7 21 10 3M17 21 14 3M12 5v3M12 11v3M12 17v3"/>',
            128295: '<path d="M14 4 4 14l6 6L20 10l-6-6ZM4 14l-2-2 4-4 2 2"/>',
            128222: '<path d="M6 3h4l2 5-2 2c1 3 2 4 5 5l2-2 4 2v4c-7 2-15-6-15-16Z"/>',
            9993: '<path d="M3 5h18v14H3zM3 6l9 7 9-7"/>',
            128196: '<path d="M6 3h9l3 3v15H6zM15 3v4h4M9 12h6M9 16h6"/>',
            128640: '<path d="m12 3 4 6-1 7H9l-1-7 4-6ZM9 16l-3 5M15 16l3 5M12 9h.01"/>',
            128241: '<path d="M7 3h10v18H7zM10 6h4M11 18h2"/>',
            127757: '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18"/>',
            127922: '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>'
        };
        var emojiPattern = /[\u{1F300}-\u{1FAFF}\u{2600}-\u{27BF}]/gu;
        var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
        var nodes = [];
        var node;
        while ((node = walker.nextNode())) {
            if (node.parentElement && !node.parentElement.closest('script,style,textarea')) nodes.push(node);
        }
        nodes.forEach(function (textNode) {
            var value = textNode.nodeValue;
            if (!emojiPattern.test(value)) { emojiPattern.lastIndex = 0; return; }
            emojiPattern.lastIndex = 0;
            var fragment = document.createDocumentFragment();
            var lastIndex = 0;
            value.replace(emojiPattern, function (emoji, offset) {
                fragment.append(value.slice(lastIndex, offset));
                var icon = document.createElement('span');
                icon.className = 'site-icon';
                icon.setAttribute('aria-hidden', 'true');
                icon.innerHTML = '<svg viewBox="0 0 24 24">' + (iconPaths[emoji.codePointAt(0)] || '<circle cx="12" cy="12" r="8"/><path d="M8 12h8"/>') + '</svg>';
                fragment.append(icon);
                lastIndex = offset + emoji.length;
            });
            fragment.append(value.slice(lastIndex));
            textNode.parentNode.replaceChild(fragment, textNode);
        });
    });
</script>
