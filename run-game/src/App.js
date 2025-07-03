import React, { useState, useEffect, useCallback } from 'react';
import './App.css';

const App = () => {
  const [gameState, setGameState] = useState('start'); // 'start', 'playing', 'gameOver'
  const [score, setScore] = useState(0);
  const [highScore, setHighScore] = useState(localStorage.getItem('runGameHighScore') || 0);
  const [player, setPlayer] = useState({
    y: 200, // ground level
    isJumping: false,
    jumpVelocity: 0
  });
  const [obstacles, setObstacles] = useState([]);
  const [gameSpeed, setGameSpeed] = useState(2);

  // Game constants
  const GROUND_HEIGHT = 200;
  const JUMP_FORCE = -15;
  const GRAVITY = 0.8;
  const PLAYER_SIZE = 40;
  const OBSTACLE_WIDTH = 30;
  const OBSTACLE_HEIGHT = 60;

  // Generate obstacles
  const generateObstacle = useCallback(() => {
    return {
      x: 800,
      y: GROUND_HEIGHT - OBSTACLE_HEIGHT,
      width: OBSTACLE_WIDTH,
      height: OBSTACLE_HEIGHT,
      id: Date.now() + Math.random()
    };
  }, []);

  // Jump mechanics
  const jump = useCallback(() => {
    if (gameState === 'playing' && !player.isJumping) {
      setPlayer(prev => ({
        ...prev,
        isJumping: true,
        jumpVelocity: JUMP_FORCE
      }));
    }
  }, [gameState, player.isJumping]);

  // Handle keyboard input
  useEffect(() => {
    const handleKeyPress = (e) => {
      if (e.code === 'Space') {
        e.preventDefault();
        if (gameState === 'start' || gameState === 'gameOver') {
          startGame();
        } else if (gameState === 'playing') {
          jump();
        }
      }
    };

    document.addEventListener('keydown', handleKeyPress);
    return () => document.removeEventListener('keydown', handleKeyPress);
  }, [gameState, jump]);

  // Start game
  const startGame = () => {
    setGameState('playing');
    setScore(0);
    setPlayer({ y: GROUND_HEIGHT, isJumping: false, jumpVelocity: 0 });
    setObstacles([]);
    setGameSpeed(2);
  };

  // Game over
  const endGame = () => {
    setGameState('gameOver');
    if (score > highScore) {
      setHighScore(score);
      localStorage.setItem('runGameHighScore', score);
    }
  };

  // Collision detection
  const checkCollision = useCallback((playerY, obstacle) => {
    const playerLeft = 100;
    const playerRight = playerLeft + PLAYER_SIZE;
    const playerTop = playerY;
    const playerBottom = playerY + PLAYER_SIZE;

    const obstacleLeft = obstacle.x;
    const obstacleRight = obstacle.x + obstacle.width;
    const obstacleTop = obstacle.y;
    const obstacleBottom = obstacle.y + obstacle.height;

    return (
      playerRight > obstacleLeft &&
      playerLeft < obstacleRight &&
      playerBottom > obstacleTop &&
      playerTop < obstacleBottom
    );
  }, []);

  // Game loop
  useEffect(() => {
    if (gameState !== 'playing') return;

    const gameLoop = setInterval(() => {
      // Update player physics
      setPlayer(prev => {
        let newY = prev.y;
        let newJumpVelocity = prev.jumpVelocity;
        let newIsJumping = prev.isJumping;

        if (prev.isJumping) {
          newY += newJumpVelocity;
          newJumpVelocity += GRAVITY;

          if (newY >= GROUND_HEIGHT) {
            newY = GROUND_HEIGHT;
            newIsJumping = false;
            newJumpVelocity = 0;
          }
        }

        return {
          y: newY,
          isJumping: newIsJumping,
          jumpVelocity: newJumpVelocity
        };
      });

      // Update obstacles
      setObstacles(prev => {
        let newObstacles = prev.map(obstacle => ({
          ...obstacle,
          x: obstacle.x - gameSpeed
        })).filter(obstacle => obstacle.x > -OBSTACLE_WIDTH);

        // Add new obstacles
        if (newObstacles.length === 0 || newObstacles[newObstacles.length - 1].x < 600) {
          if (Math.random() < 0.02) {
            newObstacles.push(generateObstacle());
          }
        }

        return newObstacles;
      });

      // Update score and speed
      setScore(prev => {
        const newScore = prev + 1;
        if (newScore % 500 === 0) {
          setGameSpeed(speed => Math.min(speed + 0.5, 8));
        }
        return newScore;
      });
    }, 16); // ~60 FPS

    return () => clearInterval(gameLoop);
  }, [gameState, gameSpeed, generateObstacle]);

  // Check collisions
  useEffect(() => {
    if (gameState === 'playing') {
      obstacles.forEach(obstacle => {
        if (checkCollision(player.y, obstacle)) {
          endGame();
        }
      });
    }
  }, [gameState, player.y, obstacles, checkCollision]);

  return (
    <div className="game-container">
      <div className="game-header">
        <div className="score">Score: {score}</div>
        <div className="high-score">High Score: {highScore}</div>
        <div className="speed">Speed: {gameSpeed.toFixed(1)}x</div>
      </div>

      <div className="game-world">
        {/* Background */}
        <div className="background">
          <div className="clouds">
            <div className="cloud cloud-1">☁️</div>
            <div className="cloud cloud-2">☁️</div>
            <div className="cloud cloud-3">☁️</div>
          </div>
        </div>

        {/* Ground */}
        <div className="ground"></div>

        {/* Player */}
        <div 
          className={`player ${player.isJumping ? 'jumping' : 'running'}`}
          style={{ 
            bottom: `${400 - player.y - PLAYER_SIZE}px`,
            left: '100px'
          }}
        >
          🏃‍♂️
        </div>

        {/* Obstacles */}
        {obstacles.map(obstacle => (
          <div
            key={obstacle.id}
            className="obstacle"
            style={{
              left: `${obstacle.x}px`,
              bottom: `${400 - obstacle.y - obstacle.height}px`,
              width: `${obstacle.width}px`,
              height: `${obstacle.height}px`
            }}
          >
            🌵
          </div>
        ))}

        {/* Game UI Overlays */}
        {gameState === 'start' && (
          <div className="game-overlay">
            <div className="overlay-content">
              <h1>🏃‍♂️ Run Game</h1>
              <p>Press SPACEBAR to jump and avoid obstacles!</p>
              <button onClick={startGame} className="start-button">
                Press SPACE to Start
              </button>
            </div>
          </div>
        )}

        {gameState === 'gameOver' && (
          <div className="game-overlay">
            <div className="overlay-content">
              <h2>Game Over!</h2>
              <p>Your Score: {score}</p>
              <p>High Score: {highScore}</p>
              {score > highScore - score && <p className="new-record">🎉 New High Score!</p>}
              <button onClick={startGame} className="restart-button">
                Press SPACE to Restart
              </button>
            </div>
          </div>
        )}
      </div>

      <div className="game-instructions">
        <p>Use SPACEBAR to jump over obstacles • The game gets faster as your score increases!</p>
      </div>
    </div>
  );
};

export default App;
