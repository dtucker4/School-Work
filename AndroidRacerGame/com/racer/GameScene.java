package com.racer;

import org.andengine.engine.camera.hud.HUD;
import org.andengine.engine.camera.hud.controls.AnalogOnScreenControl;
import org.andengine.engine.camera.hud.controls.BaseOnScreenControl;
import org.andengine.engine.handler.IUpdateHandler;
import org.andengine.engine.handler.physics.PhysicsHandler;
import org.andengine.engine.handler.timer.ITimerCallback;
import org.andengine.engine.handler.timer.TimerHandler;
import org.andengine.entity.primitive.Rectangle;
import org.andengine.entity.sprite.Sprite;
import org.andengine.entity.text.Text;
import org.andengine.entity.text.TextOptions;
import org.andengine.extension.physics.box2d.FixedStepPhysicsWorld;
import org.andengine.extension.physics.box2d.PhysicsFactory;
import org.andengine.extension.physics.box2d.PhysicsWorld;
import org.andengine.extension.tmx.TMXLayer;
import org.andengine.extension.tmx.TMXLoader;
import org.andengine.extension.tmx.TMXObject;
import org.andengine.extension.tmx.TMXObjectGroup;
import org.andengine.extension.tmx.TMXProperties;
import org.andengine.extension.tmx.TMXTile;
import org.andengine.extension.tmx.TMXTileProperty;
import org.andengine.extension.tmx.TMXTiledMap;
import org.andengine.extension.tmx.util.exception.TMXLoadException;
import org.andengine.opengl.texture.TextureOptions;
import org.andengine.util.adt.align.HorizontalAlign;
import org.andengine.util.debug.Debug;
import org.andengine.util.math.MathUtils;
import android.util.Log;

import com.badlogic.gdx.math.Vector2;
import com.badlogic.gdx.physics.box2d.Body;
import com.badlogic.gdx.physics.box2d.BodyDef;
import com.badlogic.gdx.physics.box2d.FixtureDef;

public class GameScene extends BaseScene {
    // ===========================================================
    // Constants
    // ===========================================================

    // ===========================================================
    // Fields
    // ===========================================================

    private TMXTiledMap mTMXTiledMap;
    private int mPlayerSpeed = 1000;
    private Sprite mCar;
    private PhysicsHandler physicsHandler;
    private PhysicsWorld mPhysicsWorld;
    private boolean m1 = false;
    private boolean m2 = false;
    private boolean m3 = false;
    private int lapNum = 1;
    private Text lapText;
    private Text timeText;
    private Text speedText;
    private int mSecondsPlayed;
    private int speed;
    private HUD gameHUD;
    private LevelCompleteWindow levelCompleteWindow;
    @Override
    public void createScene() {

        createPhysics();
        initRacetrack();
        createHUD();

        initCar();
        initControls();

        physicsHandler = new PhysicsHandler(this.mCar);
        mCar.registerUpdateHandler(physicsHandler);
        registerUpdateHandler(this.mPhysicsWorld);
        camera.setChaseEntity(mCar);

        levelCompleteWindow = new LevelCompleteWindow(vbom);

        this.registerUpdateHandler(new TimerHandler(1.0f, true, new ITimerCallback() {
            @Override
            public void onTimePassed(final TimerHandler pTimerHandler) {
                mSecondsPlayed++;
                timeText.setText(String.valueOf(mSecondsPlayed));
            }
        }));

    }
    @Override
    public void onBackKeyPressed() {
        camera.setChaseEntity(null);
        camera.set(0,0,1280,720);

        camera.getHUD().setVisible(false);

        SceneManager.getInstance().loadMenuScene(engine);
    }

    @Override
    public SceneManager.SceneType getSceneType() {
        return null;
    }

    @Override
    public void disposeScene() {

    }

    // ===========================================================
    // Methods

    private void createHUD()
    {
        gameHUD = new HUD();
        speedText = new Text(20, 20, resourcesManager.font, "0 KM/H", "xxxxx KM/H".length(),vbom);
        speedText.setAnchorCenter(0, 0);
        speedText.setText("0 KM/H");
        gameHUD.attachChild(speedText);

        timeText = new Text(500, 650, resourcesManager.font, "Seconds elapsed:", "Seconds elapsed: XXXXX".length(),vbom);
        timeText.setAnchorCenter(0, 0);
        timeText.setText("time: 0");
        gameHUD.attachChild(timeText);

        lapNum =1;
        lapText = new Text(20, 650, resourcesManager.font, "Lap: 0123456789", new TextOptions(HorizontalAlign.LEFT), vbom);
        lapText.setAnchorCenter(0, 0);
        lapText.setText("Lap: " + lapNum + "/3");
        gameHUD.attachChild(lapText);

        camera.setHUD(gameHUD);
    }

    private void createPhysics()
    {
        this.mPhysicsWorld = new FixedStepPhysicsWorld(30, new Vector2(0, 0), false, 8, 1);
        registerUpdateHandler(mPhysicsWorld);
    }

    private void createWallObjects(TMXTiledMap map){

        // Loop through the object groups
        for(final TMXObjectGroup group: map.getTMXObjectGroups()) {
            if(group.getTMXObjectGroupProperties().containsTMXProperty("wall", "true")){
                for(final TMXObject object : group.getTMXObjects()) {

                    final Rectangle rect = new Rectangle(object.getX(), object.getY(),object.getWidth(), object.getHeight(),vbom);
                    final FixtureDef boxFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
                    PhysicsFactory.createBoxBody(mPhysicsWorld, rect, BodyDef.BodyType.StaticBody, boxFixtureDef);
                    rect.setColor(.5f,.5f,.5f);
                    rect.setAlpha(.5f);
                    rect.setVisible(false);

                    this.attachChild(rect);
                    this.registerUpdateHandler(new IUpdateHandler() {
                        @Override
                        public void reset() { }

                        @Override
                        public void onUpdate(final float pSecondsElapsed) {

                            if(mCar.collidesWith(rect)) {

                                mPlayerSpeed = 10;
                            }
                        }
                    });
                }
            }

        }

    }
    private void createGrassObjects(TMXTiledMap map){

        // Loop through the object groups
        for(final TMXObjectGroup group: map.getTMXObjectGroups()) {
            if(group.getTMXObjectGroupProperties().containsTMXProperty("grass", "true")){
                for(final TMXObject object : group.getTMXObjects()) {

                    final Rectangle rect = new Rectangle(object.getX(), object.getY(),object.getWidth(), object.getHeight(),vbom);
                    final FixtureDef boxFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
                    PhysicsFactory.createBoxBody(this.mPhysicsWorld, rect, BodyDef.BodyType.StaticBody, boxFixtureDef);
                    rect.setColor(.5f,.5f,.5f);
                    rect.setAlpha(.5f);
                    rect.setVisible(false);

                    this.attachChild(rect);
                    this.registerUpdateHandler(new IUpdateHandler() {
                        @Override
                        public void reset() { }

                        @Override
                        public void onUpdate(final float pSecondsElapsed) {

                            if(mCar.collidesWith(rect)) {

                                mPlayerSpeed = 250;
                            }
                        }
                    });
                }
            }

        }

    }
    private void createRoadObjects(TMXTiledMap map){

        // Loop through the object groups
        for(final TMXObjectGroup group: map.getTMXObjectGroups()) {
            if(group.getTMXObjectGroupProperties().containsTMXProperty("road", "true")){
                for(final TMXObject object : group.getTMXObjects()) {

                    final Rectangle rect = new Rectangle(object.getX(), object.getY(),object.getWidth(), object.getHeight(),vbom);
                    final FixtureDef boxFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
                    PhysicsFactory.createBoxBody(this.mPhysicsWorld, rect, BodyDef.BodyType.StaticBody, boxFixtureDef);
                    rect.setColor(.5f,.5f,.5f);
                    rect.setAlpha(.5f);
                    rect.setVisible(false);

                    this.attachChild(rect);
                    this.registerUpdateHandler(new IUpdateHandler() {
                        @Override
                        public void reset() { }

                        @Override
                        public void onUpdate(final float pSecondsElapsed) {

                            if(mCar.collidesWith(rect)) {

                                mPlayerSpeed = 700;
                            }
                        }
                    });
                }
            }

        }

    }
    private void createMarkObjects() {
           final Rectangle mark1 = new Rectangle(1500, 2768, 88, 352, vbom);
           final FixtureDef mark1FixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
           PhysicsFactory.createBoxBody(this.mPhysicsWorld, mark1, BodyDef.BodyType.StaticBody, mark1FixtureDef);
           mark1.setColor(.5f, .5f, .5f);
           mark1.setAlpha(.5f);
           mark1.setVisible(true);

           final Rectangle mark2 = new Rectangle(2752, 1600, 408, 80, vbom);
           final FixtureDef mark2boxFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
           PhysicsFactory.createBoxBody(this.mPhysicsWorld, mark1, BodyDef.BodyType.StaticBody, mark2boxFixtureDef);
           mark2.setColor(.5f, .5f, .5f);
           mark2.setAlpha(.5f);
           mark2.setVisible(true);

           final Rectangle mark3 = new Rectangle(1500, 584, 96, 368, vbom);
           final FixtureDef mark3boxFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
           PhysicsFactory.createBoxBody(this.mPhysicsWorld, mark1, BodyDef.BodyType.StaticBody, mark3boxFixtureDef);
           mark3.setColor(.5f, .5f, .5f);
           mark3.setAlpha(.5f);
           mark3.setVisible(true);

           final Rectangle finish = new Rectangle(456, 1600, 352, 64, vbom);
           final FixtureDef finishFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);
           PhysicsFactory.createBoxBody(this.mPhysicsWorld, mark1, BodyDef.BodyType.StaticBody, finishFixtureDef);
           finish.setColor(.5f, .5f, .5f);
           finish.setAlpha(.2f);
           finish.setVisible(true);

           this.attachChild(mark1);
           this.attachChild(mark2);
           this.attachChild(mark3);
           this.attachChild(finish);

           this.registerUpdateHandler(new IUpdateHandler() {
               @Override
               public void reset() {
               }

               @Override
               public void onUpdate(final float pSecondsElapsed) {

                   if (mCar.collidesWith(mark1)) {
                       m1 = true;
                       mark1.setColor(0f, .5f, 0f);
                       Log.d("mark1", String.valueOf(m1));
                   }
                   if (mCar.collidesWith(mark2)) {
                       m2 = true;
                       mark2.setColor(0f, .5f, 0f);
                   }
                   if (mCar.collidesWith(mark3)) {
                       m3 = true;
                       mark3.setColor(0f, .5f, 0f);
                   }
                   if (mCar.collidesWith(finish)) {
                       if (m1 && m2 && m3) {
                           lapNum++;
                           lapText.setText("Lap: " + lapNum + "/3");
                           mark1.setColor(.5f, .5f, .5f);
                           mark2.setColor(.5f, .5f, .5f);
                           mark3.setColor(.5f, .5f, .5f);
                           m1 = false;
                           m2 = false;
                           m3 = false;
                           if(lapNum == 4){
                               if(mSecondsPlayed < 40)
                                    levelCompleteWindow.display(LevelCompleteWindow.StarsCount.THREE, GameScene.this, camera);
                               else if(mSecondsPlayed > 60)
                                   levelCompleteWindow.display(LevelCompleteWindow.StarsCount.ONE, GameScene.this, camera);
                               else
                                   levelCompleteWindow.display(LevelCompleteWindow.StarsCount.TWO, GameScene.this, camera);
                           }
                       }
                   }

               }

           });
       }

    private void initRacetrack() {

// Load the TMX map
        try {
            final TMXLoader tmxLoader = new TMXLoader(activity, engine.getTextureManager(),
                    TextureOptions.DEFAULT, vbom,
                    new TMXLoader.ITMXTilePropertiesListener() {
                        @Override
                        public void onTMXTileWithPropertiesCreated(TMXTiledMap pTMXTiledMap, TMXLayer pTMXLayer, TMXTile pTMXTile, TMXProperties<TMXTileProperty> pTMXTileProperties) {
                            if(pTMXTileProperties.containsTMXProperty("trees", "true")) {


                            }
                        }
                    });
            this.mTMXTiledMap = tmxLoader.loadFromAsset("tmx/RaceMap1.tmx");
            this.mTMXTiledMap.setOffsetCenter(0, 0);
        } catch (final TMXLoadException e) {
            Debug.e(e);
        }
        this.attachChild(mTMXTiledMap);
        this.createWallObjects(mTMXTiledMap);
        this.createGrassObjects(mTMXTiledMap);
        this.createRoadObjects(mTMXTiledMap);
        this.createMarkObjects();


    }
    private void initCar() {
        this.mCar = new Sprite(500, 1400, resourcesManager.mPlayerTextureRegion, vbom);
        this.mCar.setOffsetCenterY(0);
        final FixtureDef carFixtureDef = PhysicsFactory.createFixtureDef(0, 0, 1f);

        Body mCarBody = PhysicsFactory.createBoxBody(this.mPhysicsWorld, this.mCar, BodyDef.BodyType.DynamicBody, carFixtureDef);
        camera.setChaseEntity(mCar);
        this.attachChild(this.mCar);
    }
    private void initControls(){
        final AnalogOnScreenControl velocityOnScreenControl = new AnalogOnScreenControl(1050, 100,
                camera, resourcesManager.mOnScreenControlBaseTextureRegion, resourcesManager.mOnScreenControlKnobTextureRegion,
                0.1f, vbom, new AnalogOnScreenControl.IAnalogOnScreenControlListener()
        {
            @Override
            public void onControlChange(final BaseOnScreenControl pBaseOnScreenControl, final float pValueX, final float pValueY) {
                physicsHandler.setVelocity(pValueX * mPlayerSpeed, pValueY * mPlayerSpeed);
                if(pValueX == 0 && pValueY == 0) {
                    speedText.setText("0 KM/H");
                } else {
                    int velx = ((int)(Math.abs(physicsHandler.getVelocityX())))/5;
                    int vely = ((int)(Math.abs(physicsHandler.getVelocityY())))/5;
                    if(velx > vely)
                        speed = velx;
                    else
                        speed = vely;
                    speedText.setText(speed +" KM/H");
                    mCar.setRotation(MathUtils.radToDeg((float)Math.atan2(pValueX, pValueY)));
                }
            }

            @Override
            public void onControlClick(final AnalogOnScreenControl pAnalogOnScreenControl) {
				/* Nothing. */
            }
        });

        {
            final Sprite controlBase = velocityOnScreenControl.getControlBase();
            controlBase.setAlpha(0.5f);
            controlBase.setOffsetCenter(0, 0);
            controlBase.setScale(1.8f);
            this.setChildScene(velocityOnScreenControl);
        }
    }


}
