# 🏃‍♂️ Run Game

A fun and engaging endless runner game built with React! Test your reflexes as you jump over obstacles and try to achieve the highest score possible.

## 🎮 Game Features

- **Endless Runner Gameplay**: The game continues indefinitely with increasing difficulty
- **Smooth Animations**: Fluid character movements and environmental effects
- **Dynamic Speed**: Game speed increases as your score grows higher
- **High Score Tracking**: Your best score is saved locally and persists between sessions
- **Responsive Design**: Works great on desktop, tablet, and mobile devices
- **Beautiful Graphics**: Modern UI with gradient backgrounds, animated clouds, and visual effects

## 🕹️ How to Play

### Controls
- **SPACEBAR**: Jump over obstacles
- **SPACEBAR**: Start the game (from start screen)
- **SPACEBAR**: Restart the game (from game over screen)

### Gameplay
1. Press SPACEBAR to start the game
2. Your character will automatically run from left to right
3. Press SPACEBAR to jump over cactus obstacles (🌵)
4. Avoid hitting obstacles or you'll lose!
5. Your score increases continuously as you survive
6. The game speed increases every 500 points
7. Try to beat your high score!

## 🏆 Scoring System

- **Points**: Earned continuously while playing
- **Speed Bonus**: Game gets faster every 500 points (up to 8x speed)
- **High Score**: Your best score is automatically saved
- **New Record**: Get a special celebration when you beat your high score!

## 🎨 Visual Elements

- **Player Character**: 🏃‍♂️ (with running and jumping animations)
- **Obstacles**: 🌵 (animated cacti)
- **Background**: Moving clouds ☁️ and animated grass 🌱
- **Modern UI**: Glass morphism effects and smooth gradients

## 🛠️ Technical Details

- Built with **React 18** and functional components
- Uses **React Hooks** (useState, useEffect, useCallback) for state management
- **60 FPS** game loop for smooth gameplay
- **Collision Detection** with precise boundary checking
- **Physics Engine** with gravity and jump mechanics
- **Local Storage** for high score persistence
- **CSS Animations** and keyframes for visual effects

## 🚀 Getting Started

1. **Install Dependencies**:
   ```bash
   npm install
   ```

2. **Start the Game**:
   ```bash
   npm start
   ```

3. **Open in Browser**:
   The game will automatically open at `http://localhost:3000`

4. **Build for Production**:
   ```bash
   npm run build
   ```

## 📱 Mobile Support

The game is fully responsive and works great on mobile devices. Simply tap the screen to jump instead of using the spacebar.

## 🎯 Game Tips

- **Timing is Key**: Don't jump too early or too late
- **Stay Focused**: The game gets faster as you progress
- **Practice Makes Perfect**: Learn the jump timing to achieve higher scores
- **Watch the Speed**: Keep an eye on the speed indicator in the top bar

## 🔧 Development

### Project Structure
```
src/
├── App.js          # Main game component with all game logic
├── App.css         # Complete game styling and animations
├── index.js        # React app entry point
└── index.css       # Global styles
```

### Key Components
- **Game Loop**: 60 FPS interval with physics updates
- **Player Physics**: Gravity-based jumping with realistic feel
- **Obstacle System**: Procedural generation with smart spacing
- **Collision Detection**: Pixel-perfect boundary checking
- **State Management**: Clean React hooks implementation

## 🎵 Future Enhancements

Some ideas for future updates:
- Sound effects and background music
- Power-ups and special abilities
- Different obstacle types
- Multiple character choices
- Leaderboards and social features
- Different environments/themes

## 📄 License

This project is open source and available under the MIT License.

---

**Have fun playing! 🎮**

Challenge yourself to beat your high score and see how fast you can go!
