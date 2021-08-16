"use strict";

module.exports = {
  up: async (queryInterface, Sequelize) => {
    /**
     * Add seed commands here.
     *
     * Example:
     * await queryInterface.bulkInsert('People', [{
     *   name: 'John Doe',
     *   isBetaMember: false
     * }], {});
     */
    await queryInterface.bulkInsert(
      "user",
      [
        {
          id: 1,
          name: "IA",
          gender: "Male",
          role: "admin",
          email: "israr46ansari@gmail.com",
          password: "123456!",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 2,
          name: "IA 02",
          gender: "Male",
          role: "user",
          email: "test@gmail.com",
          password: "654321!",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 3,
          name: "SA",
          gender: "Female",
          role: "user",
          email: "abc@gmail.com",
          password: "asdfgh!",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
        {
          id: 4,
          name: "ZA",
          gender: "Female",
          role: "user",
          email: "bca@gmail.com",
          password: "qwerty!",
          createdAt: new Date(),
          updatedAt: new Date(),
        },
      ],
      {}
    );
  },

  down: async (queryInterface, Sequelize) => {
    /**
     * Add commands to revert seed here.
     *
     * Example:
     * await queryInterface.bulkDelete('People', null, {});
     */
  },
};
