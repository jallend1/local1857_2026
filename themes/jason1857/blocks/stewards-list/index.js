/**
 * Editor registration for jason1857/stewards-list block.
 */
(function (blocks, element, serverSideRender, blockEditor) {
  var el = element.createElement;

  blocks.registerBlockType("jason1857/stewards-list", {
    edit: function () {
      var blockProps = blockEditor.useBlockProps();

      return el(
        "div",
        blockProps,
        el(serverSideRender, {
          block: "jason1857/stewards-list",
        }),
      );
    },
    save: function () {
      return null;
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.serverSideRender,
  window.wp.blockEditor,
);
