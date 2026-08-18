(function (blocks, element, blockEditor) {
  var el = element.createElement;

  blocks.registerBlockType("jason1857/officer-cards", {
    edit: function () {
      var blockProps = blockEditor.useBlockProps();
      return el(
        "div",
        blockProps,
        el(
          "p",
          { style: { fontStyle: "italic", opacity: 0.6 } },
          "Officer Cards block — displays officer cards on the front end.",
        ),
      );
    },
    save: function () {
      return null;
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
