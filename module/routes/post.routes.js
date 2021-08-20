const express = require("express");
// const { grantAccess } = require("../verification");
const router = express.Router();
const controller = require("../controller/post.controller");
router.post("/add-new/:id", controller.addNewPost);
// router.get("/", grantAccess(["admin"]), controller.findAllPost);
router.get("/:sort?/:pageNo?", controller.findAllPost);
router.get("/delete-post/:id", controller.deleteSpecficPost);
router.post("/update-user/:id", controller.updateSpecficPost);
router.get("/:id", controller.singlePost);

module.exports = router;
