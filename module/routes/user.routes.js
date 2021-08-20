const express = require("express");
// const { grantAccess } = require("../verification");
const router = express.Router();
const controller = require("../controller/user.controller");
router.post("/add-new", controller.addNewUser);
// router.get("/", grantAccess(["admin"]), controller.findAllUser);
router.get("/", controller.findAllUser);
router.get("/delete-user/:id", controller.deleteSpecficUser);
router.post("/update-user/:id", controller.updateSpecficUser);
router.post("/loginUser", controller.loginUser);
router.get("/getPosts/:id", controller.getAllPostsOfThisUser);

module.exports = router;
