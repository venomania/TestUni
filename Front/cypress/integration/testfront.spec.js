describe("RickanMorty", () => {
    
    it("visit site", () => {
      cy.visit("http://localhost:3000");
    });
    it("visit titel", () => {
        cy.visit("http://localhost:3000");
        cy.contains("Page d'accueil");
      });
      it("detaille", () => {
        cy.visit("http://localhost:3000");
        cy.wait(10000);
        cy.get('#2').click();
      });
      it("ajout", () => {
        cy.visit("http://localhost:3000");
        cy.wait(10000);
        cy.get('#2').click();
        cy.contains("Ajouter au panier").click();
        cy.wait(10000);
        cy.contains("Enregistré dans le panier");
      });
      it("panier", () => {
        cy.visit("http://localhost:3000");
        cy.wait(10000);
        cy.contains("Aller sur panier").click();

      });

      it("supp", () => {
        cy.visit("http://localhost:3000");
        cy.wait(10000);
        cy.contains("Aller sur panier").click();
        cy.wait(30000);
        cy.contains("Supprimer du panier").click();
        cy.wait(10000);
        cy.contains("Produit bien supprimé");
      });
  });
