# 🚀 ProjectPulse

**ProjectPulse** est une solution innovante pour les développeurs web qui souhaitent obtenir une vue d'ensemble rapide de la santé de leurs projets. Ce tableau de bord moderne offre des outils pour suivre l'évolution et la progression de vos projets **xampp** et **htdocs**.

Avec **ProjectPulse**, vous pouvez :

-   ✅ Suivre la progression de vos projets.
-   🕒 Visualiser l'évolution de vos projets au fil du temps.
-   📁 Créer une structure de base pour de nouveaux projets, avec tous les fichiers et dossiers nécessaires.
-   🔄 Personnaliser vos propres structures de projet et les sauvegarder pour une utilisation ultérieure.

---

## 🌟 Fonctionnalités principales

1. **Tableau de bord intuitif** :

    - Une interface utilisateur claire pour visualiser vos projets en un coup d'œil.

2. **Création de structures de projet** :

    - Génération automatique de fichiers et de dossiers pour démarrer rapidement un projet.
    - Possibilité de définir et d'utiliser vos propres modèles personnalisés.

3. **Compatibilité avec XAMPP** :
    - Optimisé pour les environnements de développement locaux utilisant **xampp** (**lampp** et **wampp** sont des alternatives possibles. Toutes fois, non testé, alors n'hésiter pas à me rapporter des bugs si nécessaire ici : <a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new">lien</a>).

---

## 📂 Arborescence du projet

Voici un aperçu des principaux dossiers et fichiers du projet :

```plaintext
ProjectPulse/
├── data/           # Données liées aux projets
├── function/       # Fonctions PHP principales
├── includes/       # Fichiers inclus pour le fonctionnement
├── interface/      # Interface utilisateur (HTML, CSS, JS)
├── page/           # Pages spécifiques du projet
├── post/           # Gestion des requêtes POST
├── public/         # Fichiers accessibles publiquement
├── LICENSE         # Licence du projet (GPL-3.0)
├── README.md       # Documentation (ce fichier !)
├── index.php       # Point d'entrée principal
```

---

## ⚙️ Installation

Pour utiliser **ProjectPulse**, suivez ces étapes simples :

<ol>
<li>
Pré-requis :
<ul>
<li>
Un serveur local fonctionnant avec xampp ( lampp et wampp sont des alternatives possibles. Toutes fois, non testé, alors n'hésiter pas à me rapporter des bugs si nécessaire ici : <a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new">lien</a>).
</li>
<li>
Une version récente de PHP (>= 8.2.X).
</li>
</ul>
</li>
<li>
Cloner le dépôt :

```bash
git clone https://github.com/MarcusIsLion/ProjectPulse.git
```

</li>
<li>
Configurer le projet :
<ul>
<li>
Placez les fichiers dans le répertoire htdocs de votre installation XAMPP.
</li>
<li>
Démarrez Apache et MySQL (non nécessaire pour faire tourner ProjectPulse mais pour vos projets oui) via le panneau de contrôle XAMPP.
</li>
</ul>
</li>
<li>
Accéder au tableau de bord :
<ul>
<li>
Ouvrez votre navigateur et accédez à : <a href="http://localhost">http://localhost</a>.
</li>
</ul>
</li>
</ol>

---

## 🛠️ Technologies utilisées

<ul>
<li>
Langages :
<ul>
<li>
PHP (49.8%)
</li>
<li>
CSS (27.2%)
</li>
<li>
JavaScript (23.0%)
</li>
</li>
</ul>
<li>
Outils :
<ul>
<li>
XAMPP pour l'environnement de développement local.
</li>
<li>
MySQL pour la gestion des données.
</li>
</ul>
</li>
</ul>

---

## 🚧 Fonctionnalités à venir

Voici quelques améliorations prévues pour les prochaines versions :

<ul>
<li>
🌐 Possibilité d'intégration avec des frameworks front-end.
</li>
</li>
</ul>

---

## 📝 Licence

Ce projet est distribué sous la licence GNU General Public License v3.0. Consultez le fichier LICENSE.md pour plus de détails.

---

## 👤 Auteur

Ce projet a été créé et est maintenu par :

<ul>
<li>
MarcusIsLion
<ul>
<li>
<a href="https://github.com/MarcusIsLion">🌐 Profil GitHub</a>
</li>
</ul>
</li>
</ul>

---

## 💬 Contribuer

Les contributions sont les bienvenues ! Voici comment vous pouvez aider :

<ol>
<li>
Forkez le projet.
</li>
<li>
Créez une branche pour votre fonctionnalité ou correctif :

```bash
git checkout -b feature/mon-amélioration
```

</li>
<li>
Effectuez vos modifications et ajoutez un commit :

```bash
git commit -m "Ajout de ma nouvelle fonctionnalité"
```

</li>
<li>
Poussez les modifications sur votre dépôt forké :

```bash
git push origin feature/mon-amélioration
```

</li>
<li>
Créez une Pull Request sur le dépôt principal.
</li>
</ol>

---

## 🏗️ Prochaine version

Voici les améliorations prévues pour la prochaine version.

🚧 En cours 🚧

<ul>
<li>
🐛 le thème ne se sauvegarde pas dans la default page.
</li>
<li>
🔨 initialisation des tests.
</li>
<li>
🔐 Retravail du post-traitement pour inclure la sécurité (pour éviter les erreurs potentielles).
</li>
<li>
✏️ Revue des fichiers js.
</li>
<li>
📦️ besoin de réduire la taille du projet.
</li>
<li>
✏️ Revue des fichiers css.
</li>
<li>
🗃️ Possibilité de supprimer une structure locale.
</li>
<li>
📱 Retravail sur la structure du projet.
</li>
<li>
👷 Continuation de la transition vers un programme POO.
</li>
<li>
🧱 Ajout de controller.
</li>
<li>
🔀 Création du système de template.
</li>
</li>
</ul>

✅ Réalisé ✅

<ul>
<li>
📝 Refonte du README. 
</li>
</li>
</ul>

---

## 📅 Historique des versions

<ol>
<li>
<a href="https://github.com/MarcusIsLion/ProjectPulse/releases/tag/v1.0">v1.0 (7 octobre 2024) :</a>
<ul>
<li>
Première version stable avec les fonctionnalités de base.
</li>
</ul>
</li>
</ol>

---

## ❤️ Remerciements

Un grand merci à tous les développeurs et contributeurs open source qui rendent ce projet possible !
